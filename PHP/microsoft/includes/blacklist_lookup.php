<?php
class IpList {

	private $iplist = array();
	private $ipfile = "";

	public function __construct( $list ) {
		$contents = array();
		$this->ipfile = $list;
		$lines = $this->read( $list );
		foreach( $lines as $line ) {
			$line = trim( $line );
			# remove comment and blank lines
			if ( empty($line ) ) {
				continue;
			}
			if ( $line[0] == '#' ) {
				continue;
			}
			# remove on line comments
			$temp = explode( "#", $line );
			$line = trim( $temp[0] );
			# create content array
			$contents[] = $this->normal($line);
		}		
		$this->iplist = $contents;
	}
	
	public function __destruct() {
	}
	
	public function __toString() {
		return implode(' ',$this->iplist);
	}
	
	public function is_inlist( $ip ) {
		$retval = false;		
		foreach( $this->iplist as $ipf ) {
			$retval = $this->ip_in_range( $ip, $ipf );
			if ($retval === true ) {
				$this->range = $ipf;
				break;
			}
		}
		return $retval;
	}
	
	/*
	** public function that returns the ip list array
	*/
	public function iplist() {
		return $this->iplist; 
	}
	
	/*
	*/
	public function message() {
		return $this->range;
	}
	
	public function append( $ip, $comment ) {
        return file_put_contents( $this->ipfile, $ip, $comment ); 
	}
	
	public function listname() {
        return $this->ipfile;
	}
	
	/*
	** private function that reads the file into array
	*/
	private function read( $fname ) {
		try {
			$file = file( $fname, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES  );
		}
		catch( Exception $e ) {
			throw new Exception( $fname.': '.$e->getmessage() . '\n');
		}
		return $file;
	}
	
	private function ip_in_range( $ip, $range ) {
	
		// return ip_in_range( $ip, $range );
		
        if ( strpos($range, '/') !== false ) {
            // IP/NETMASK format
            list( $range, $netmask ) = explode( '/', $range, 2 );
            if ( strpos( $netmask, '.' ) !== false ) {
                // 255.255.255.0 format w/ wildcards
                $netmask = str_replace('*', '0', $netmask );
                $dnetmask = ip2long( $netmask );
                return ((ip2long( $ip ) & $dnetmask) == (ip2long($range) & $dnetmask ));
            }
            else {
                // IP/CIDR format
                // insure $range format 0.0.0.0
                $r = explode( '.', $range );
                while( count( $r ) < 4 ) {
                    $r[] = '0';
                }
                for($i = 0; $i < 4; $i++) {
                    $r[$i] = empty($r[$i]) ? '0': $r[$i];
                }
                $range = implode( '.', $r );
                // build netmask
                $dnetmask = ~(pow( 2, ( 32 - $netmask)) - 1);
                return ((ip2long($ip) & $dnetmask)==(ip2long($range) & $dnetmask));
            }
        }
        else {
            if ( strpos( $range, '*' ) !== false ) {
                // 255.255.*.* format
                $low = str_replace( '*', '0', $range );
                $high = str_replace( '*', '255', $range );
                $range = $low.'-'.$high;
            }
            if ( strpos( $range, '-') !== false ) {
                // 128.255.255.0-128.255.255.255 format
                list( $low, $high ) = explode( '-', $range, 2 );
                
                $dlow  = $this->toLongs( $low );
                $dhigh = $this->toLongs( $high );
                $dip   = $this->toLongs( $ip );
                return (($this->compare($dip,$dlow) != -1) && ($this->compare($dip,$dhigh) != 1)); 
            }
        }
        return ( $ip == $range );
	}
	
	/*
	** private function that converts single ip address to CIDR format,
	** also removes excess spaces from within the string.
	*/
	private function normal( $range ) {
		if ( strpbrk( "*-/", $range ) === False ) {
			$range .= "/32";
		}
		return str_replace( ' ', '', $range );
	}
	
	/*
	** converts an IP address to an array of two long integer,
	** due to the integer size restrictions of platforms, we
	** looseits. The commented lines will be used for future
	** IPv6 implemention.
	*/
	private function toLongs( $ip ) {
		# $Ip = $this->expand();
		# $Parts = explode(':', $Ip);
		$Parts = explode('.', $ip );
		$Ip = array('', '');
		# for ($i = 0; $i < 4; $i++) {
		for ($i = 0; $i < 2; $i++){
			$Ip[0] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);
		}
		# for ($i = 4; $i < 8; $i++) { 
		for ($i = 2; $i < 4; $i++) { 
			$Ip[1] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);
		}
        return array(base_convert($Ip[0], 2, 10), base_convert($Ip[1], 2, 10));
	}
	
	private function compare( $ipdec1, $ipdec2 ) {
        if( $ipdec1[0] < $ipdec2[0] ) {
            return -1;
        }
        elseif ( $ipdec1[0] > $ipdec2[0] ) {
            return 1;
        }
        elseif ( $ipdec1[1] < $ipdec2[1] ) {
            return -1;
        }
        elseif ( $ipdec1[1] > $ipdec2[1] ) {
            return 1;
        }
        return 0;
	}
}

/*
**  class IpBlockList( <whitelistfile>, <blacklistfile> );
**
**      If whitelist and blacklist filenames are not provided, they will
**      default to '_whitelist.dat' and '_blacklist.dat'.  If either
**      file is not present, an Exception will be thrown.  See the 
**      example '_whitelist.dat' and '_blacklist.dat' files for the
**      proper format. 
** 
**  methods:
**      boolean ipPass( <ipaddress> )
** 
*/
class IpBlockList {

    private $statusid = array( 'negative' => -1, 'neutral' => 0, 'positive' => 1 );

	private $whitelist = array();
	private $blacklist = array();
	private $message   = NULL;
	private $status    = NULL;

	public function __construct( $whitelistfile = 'includes/whitelist.dat', 
									$blacklistfile = 'includes/blacklist.dat' ) {
		$this->whitelistfile = $whitelistfile;
		$this->blacklistfile = $blacklistfile;
		
		$this->whitelist = new IpList( $whitelistfile );
		$this->blacklist = new IpList( $blacklistfile );
	}
	
	public  function    __destruct() { 
	}
	
	public function ipPass( $ip ) {
		$retval = False;
		
		if ( !filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
            throw new Exception( 'Requires valid IPv4 address' );
		}
		
		if ( $this->whitelist->is_inlist( $ip ) ) {
			// Ip is white listed, so it passes
			$retval = True;
			$this->message = $ip . " is whitelisted by ".$this->whitelist->message().".";
			$this->status = $this->statusid['positive'];
		}
		else if ( $this->blacklist->is_inlist( $ip ) ) {
			$retval = False;
			$this->message = $ip . " is blacklisted by ".$this->blacklist->message().".";
			$this->status = $this->statusid['negative'];
		}
		else {
			$retval = True;
			$this->message = $ip . " is unlisted.";
			$this->status = $this->statusid['neutral'];
		}
		return $retval;
	}
	
	public function message() {
		return $this->message;
	}

         public function status() {
             return $this->status;
         }

	public function append( $type, $ip, $comment = "" ) {
        if ($type == 'WHITELIST' ) {
            $retval = $this->whitelistfile->append( $ip, $comment );
        }
        elseif( $type == 'BLACKLIST' ) {
            $retval = $this->blacklistfile->append( $ip, $comment );
        }
        else {
            $retval = false;
        }
	}

	public function filename( $type, $ip, $comment = "" ) {
        if ($type == 'WHITELIST' ) {
            $retval = $this->whitelistfile->filename( $ip, $comment );
        }
        elseif( $type == 'BLACKLIST' ) {
            $retval = $this->blacklistfile->filename( $ip, $comment );
        }
        else {
            $retval = false;
        }
	}
}

?>