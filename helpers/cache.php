<?php
if(!defined('METAL_LIBRARY_CACHE_FILE_CACHE_CLASS'))
{
	define('METAL_LIBRARY_CACHE_FILE_CACHE_CLASS',1);

/*
 *
 * Copyright © (C) Manuel Lemos 2001-2003
 *
 * @(#) $Id: filecacheclass.class,v 1.33 2009/04/30 03:22:25 mlemos Exp $
 *
 */

class file_cache_class
{
	/*
	 * Protected variables
	 *
	 */
	var $read_cache_file;
	var $read_cache_file_opened=0;
	var $write_cache_file;
	var $write_cache_file_opened=0;
	var $writtenheaders=0;
	
	/*
	 * Public variables
	 *
	 */
	var $path='';
	var $flush_cache_file=0;
	var $error='';
	var $reopenupdatedcache=1;
	var $headers=array();
	var $cache_buffer_length=100000;
	var $automatic_headers=1;
	var $verify_headers=array();
	
	
	/*
	 * Protected functions
	 *
	 */
	Function writecachedata($data)
	{
		if((fwrite($this->write_cache_file,$data,strlen($data))!=0))
			return 1;
		$this->error='could not write to the cache file';
		return 0;
	}
	
	Function readcachedata(&$data,$length)
	{
		if($length<=0)
		{
			$this->error='it was specified an invalid cache data read length';
			return 0;
		}
		if(GetType($readdata=fread($this->read_cache_file,$length))=='string')
		{
			$data=$readdata;
			return 1;
		}
		$this->error='could not read from the cache file';
		return 0;
	}
	
	Function readcacheline(&$line)
	{
		if(GetType($readline=fgets($this->read_cache_file))=='string')
		{
			$line=$readline;
			return 1;
		}
		$this->error='could not read from the cache file';
		return 0;
	}
	
	Function endofcache(&$endofcache)
	{
		if(!($this->read_cache_file_opened))
		{
			$this->error='endofcache function is not implemented';
			return 0;
		}
		$endofcache=feof($this->read_cache_file);
		return 1;
	}
	
	Function cachelength(&$length)
	{
		if((GetType($filelength=@filesize($this->path))=='integer'))
		{
			$length=$filelength;
			return 1;
		}
		$this->error='could not determing cache file length';
		return 0;
	}
	
	Function cachebufferlength(&$length)
	{
		$length=$this->cache_buffer_length;
		if($length!=0 || $this->cachelength($length))
			return 1;
		$this->error=('could not get cache buffer length: '.$this->error);
		return 0;
	}
	
	Function readcacheheaders(&$read)
	{
		$this->headers=array();
		$first=1;
		for(;;)
		{
			if(!($this->readcacheline($line)))
			{
				if($first)
				{
					$read=0;
					$this->error='';
					return 1;
				}
				return 0;
			}
			if(!(strlen($line)!=0))
			{
				if($first)
				{
					$read=0;
					return 1;
				}
				break;
			}
			if(GetType($endofline=strpos($line,"\r"))=='integer')
				$line=substr($line,0,$endofline);
			if(strlen($line)==0)
			{
				break;
			}
			if(!($this->endofcache($endofcache)))
				return 0;
			if($endofcache || !GetType($space=strpos($line,' '))=='integer')
			{
				$read=0;
				return 1;
			}
			$this->headers[substr($line,0,$space)]=substr($line,($space+1),(strlen($line)-$space-1));
			$first=0;
		}
		$read=1;
		return 1;
	}
	
	Function updatedcache(&$updated)
	{
		if(!($this->readcacheheaders($updated)))
			return 0;
		if($updated)
		{
			Reset($this->verify_headers);
			$end=(GetType($headername=Key($this->verify_headers))!='string');
			for(;!$end;)
			{
				if(!IsSet($this->headers[$headername]) || (strcmp($this->headers[$headername],$this->verify_headers[$headername])))
				{
					$updated=0;
					break;
				}
				Next($this->verify_headers);
				$end=(GetType($headername=Key($this->verify_headers))!='string');
			}
		}
		if($updated && IsSet($this->headers['x-expires:']))
			$updated=(strcmp($this->headers['x-expires:'],strftime('%Y-%m-%d %H:%M:%S'))>0);
		if(!($updated))
			$this->headers=array();
		return 1;
	}
	
	Function writecache(&$data,$endofcache)
	{
		if(!$this->writtenheaders && (strlen($data)>0 || $endofcache))
		{
			$rfc822now=gmstrftime('%a, %d %b %Y %H:%M:%S GMT');
			srand(time());
			if($this->automatic_headers && (!$this->setheader('date:',$rfc822now) || !$this->setheader('etag:','"'.md5(strval(rand(0,9999)).$rfc822now).'"') || ($endofcache && !$this->setheader('content-length:',strval(strlen($data))))))
				return 0;
			Reset($this->headers);
			$end=(GetType($headername=Key($this->headers))!='string');
			for(;!$end;)
			{
				$headerdata=($headername.' '.$this->headers[$headername]."\r\n");
				if(!($this->writecachedata($headerdata)))
				{
					$this->error=('could not write the cache headers: '.$this->error);
					return 0;
				}
				Next($this->headers);
				$end=(GetType($headername=Key($this->headers))!='string');
			}
			Reset($this->verify_headers);
			$end=(GetType($headername=Key($this->verify_headers))!='string');
			for(;!$end;)
			{
				$headerdata=($headername.' '.$this->verify_headers[$headername]."\r\n");
				if(!($this->writecachedata($headerdata)))
				{
					$this->error=('could not write the cache headers: '.$this->error);
					return 0;
				}
				Next($this->verify_headers);
				$end=(GetType($headername=Key($this->verify_headers))!='string');
			}
			$headerdata="\r\n";
			if(!($this->writecachedata($headerdata)))
			{
				$this->error=('could not write to the cache header separator: '.$this->error);
				return 0;
			}
			$this->writtenheaders=1;
		}
		if(strlen($data)==0)
		{
			if(!($endofcache))
			{
				$this->error='it was specified an empty data block to store in the cache';
				return 0;
			}
		}
		else
		{
			if(!($this->writecachedata($data)))
			{
				$this->error=('could not write to the cache data: '.$this->error);
				return 0;
			}
		}
		return 1;
	}
	
	/*
	 * Public functions
	 *
	 */
	Function verifycache(&$updated)
	{
		if($this->read_cache_file_opened)
		{
			$this->error='the cache file is already opened for reading';
			return 0;
		}
		if(!strcmp($this->path,''))
		{
			$this->error='it was not specified the cache file path';
			return 0;
		}
		$updated=0;
		if(file_exists($this->path))
		{
			if(!((($this->read_cache_file=@fopen($this->path,'rb'))!=0)))
			{
				$this->error='could not open cache file for reading';
				return 0;
			}
			if(!(@flock($this->read_cache_file,1)))
			{
				fclose($this->read_cache_file);
				$this->error='could not lock shared cache file';
				return 0;
			}
			$this->read_cache_file_opened=1;
			$success=$this->updatedcache($updated);
			if(!($success))
			{
				@flock($this->read_cache_file,3);
				fclose($this->read_cache_file);
				$this->read_cache_file_opened=0;
				return 0;
			}
			if($updated)
				return 1;
			$success=@flock($this->read_cache_file,3);
			fclose($this->read_cache_file);
			$this->read_cache_file_opened=0;
			if(!($success))
			{
				$this->error='could not unlock the cache file';
				return 0;
			}
		}
		if(!((($this->read_cache_file=@fopen($this->path,'ab'))!=0)))
		{
			$this->error='could not open cache file for appending';
			return 0;
		}
		$this->read_cache_file_opened=1;
		if(!(@flock($this->read_cache_file,2)))
		{
			$this->error='could not lock exclusive cache file';
			@flock($this->read_cache_file,3);
			fclose($this->read_cache_file);
			$this->read_cache_file_opened=0;
			return 0;
		}
		if(!((($this->write_cache_file=@fopen($this->path,'wb'))!=0)))
		{
			@flock($this->read_cache_file,3);
			fclose($this->read_cache_file);
			$this->read_cache_file_opened=0;
			$this->error='could not open cache file for writing';
			return 0;
		}
		$this->write_cache_file_opened=1;
		$this->writtenheaders=0;
		$this->headers=array();
		return 1;
	}
	
	Function storedata(&$data,$endofcache)
	{
		if(!($this->write_cache_file_opened))
		{
			$this->error='cache file is not set for storing data';
			return 0;
		}
		$success=$this->writecache($data,$endofcache);
		if($success)
		{
			$success=(!$endofcache || !$this->flush_cache_file || fflush($this->write_cache_file));
			if(!($success))
				$this->error='could not flush the cache file';
		}
		if(!($success))
		{
			fclose($this->write_cache_file);
			$this->write_cache_file_opened=0;
			@flock($this->read_cache_file,3);
			fclose($this->read_cache_file);
			unlink($this->path);
			$this->read_cache_file_opened=0;
			return 0;
		}
		if(!($endofcache))
			return 1;
		fclose($this->write_cache_file);
		$this->write_cache_file_opened=0;
		@flock($this->read_cache_file,3);
		fclose($this->read_cache_file);
		$this->read_cache_file_opened=0;
		if(!($this->reopenupdatedcache))
			return 1;
		if(!((($this->read_cache_file=@fopen($this->path,'rb'))!=0)))
		{
			$this->error='could not reopen cache file for reading';
			return 0;
		}
		if(!(@flock($this->read_cache_file,1)))
		{
			fclose($this->read_cache_file);
			$this->error='could not lock shared cache file';
			return 0;
		}
		$this->read_cache_file_opened=1;
		if(!($this->readcacheheaders($read)))
			return 0;
		if(!($read))
		{
			@flock($this->read_cache_file,3);
			fclose($this->read_cache_file);
			$this->read_cache_file_opened=0;
			$this->error='could not read the cache file headers';
			return 0;
		}
		return 1;
	}
	
	Function retrievefromcache(&$data,&$endofcache)
	{
		if(!($this->read_cache_file_opened))
		{
			$this->error='cache file is not set for retrieving cached data';
			return 0;
		}
		if($this->write_cache_file_opened)
		{
			$this->error='cache file is still opened for writing';
			return 0;
		}
		$success=$this->cachebufferlength($length);
		if($success)
			$success=($length==0 || $this->readcachedata($data,$length));
		if(!($success))
		{
			@flock($this->read_cache_file,3);
			fclose($this->read_cache_file);
			$this->read_cache_file_opened=0;
			return 0;
		}
		if($length==0)
			$endofcache=1;
		else
		{
			if(!($this->endofcache($endofcache)))
			{
				@flock($this->read_cache_file,3);
				fclose($this->read_cache_file);
				$this->read_cache_file_opened=0;
				return 0;
			}
		}
		if(!($endofcache))
			return 1;
		@flock($this->read_cache_file,3);
		fclose($this->read_cache_file);
		$this->read_cache_file_opened=0;
		return 1;
	}
	
	Function closecache()
	{
		if($this->read_cache_file_opened || $this->write_cache_file_opened)
		{
			@flock($this->read_cache_file,3);
			$this->read_cache_file_opened=0;
		}
		if($this->read_cache_file_opened)
		{
			fclose($this->read_cache_file);
			$this->read_cache_file_opened=0;
		}
		if($this->write_cache_file_opened)
		{
			fclose($this->write_cache_file);
			$this->write_cache_file_opened=0;
		}
	}
	
	Function voidcache()
	{
		if($this->read_cache_file_opened)
		{
			$this->error='can not void cache with the file open for reading';
			return 0;
		}
		if(!strcmp($this->path,''))
		{
			$this->error='it was not specified the cache file path';
			return 0;
		}
		if(!(file_exists($this->path)))
			return 1;
		if(!((($this->read_cache_file=@fopen($this->path,'ab'))!=0)))
		{
			$this->error='could not open the cache file for reading';
			return 0;
		}
		if(!(@flock($this->read_cache_file,2)))
		{
			fclose($this->read_cache_file);
			$this->error='could not lock exclusive cache file';
			return 0;
		}
		$success=(($this->write_cache_file=@fopen($this->path,'wb'))!=0);
		if($success)
			fclose($this->write_cache_file);
		@flock($this->read_cache_file,3);
		fclose($this->read_cache_file);
		$this->error='could not open cache file for writing';
		unlink($this->path);
		return $success;
	}
	
	Function updating(&$updating)
	{
		if($this->read_cache_file_opened)
		{
			$this->error='the cache file is already opened for reading';
			return 0;
		}
		if(!strcmp($this->path,''))
		{
			$this->error='it was not specified the cache file path';
			return 0;
		}
		$updating=0;
		if(!(file_exists($this->path)))
			return 1;
		if(!((($this->read_cache_file=@fopen($this->path,'rb'))!=0)))
		{
			$this->error='could not open cache file for reading';
			return 0;
		}
		if(@flock($this->read_cache_file,5))
			@flock($this->read_cache_file,3);
		else
			$updating=1;
		fclose($this->read_cache_file);
		return 1;
	}
	
	Function setheader($header,$value)
	{
		if(GetType(strpos($header,' '))=='integer')
		{
			$this->error='it was specified a header name with a space in it';
			return 0;
		}
		$lowerheader=strtolower($header);
		if(IsSet($this->headers[$lowerheader]))
		{
			$this->error='it was specified a header already defined';
			return 0;
		}
		$this->headers[$lowerheader]=$value;
		return 1;
	}
	
	Function setexpirydate($date)
	{
		if(!($this->setheader('x-expires:',$date)))
			return 0;
		if($this->automatic_headers)
			return $this->setheader('expires:',gmstrftime('%a, %d %b %Y %H:%M:%S GMT',mktime(substr($date,11,2),substr($date,14,2),substr($date,17,2),substr($date,5,2),substr($date,8,2),substr($date,0,4))));
		return 1;
	}
	
	Function setexpirytime($time)
	{
		if($time<=0)
		{
			$this->error='it was not specified a valid expiry time period';
			return 0;
		}
		return $this->setexpirydate(strftime('%Y-%m-%d %H:%M:%S',time()+$time));
	}
};

}
?>
