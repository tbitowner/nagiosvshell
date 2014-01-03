<?php


// Nagios V-Shell
// Copyright (c) 2010-2011 Nagios Enterprises, LLC.
// Written by Mike Guthrie <mguthrie@nagios.com>
//
// LICENSE:
//
// This work is made available to you under the terms of Version 2 of
// the GNU General Public License. A copy of that license should have
// been provided with this software, but in any event can be obtained
// from http://www.fsf.org.
// 
// This work is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
// General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
// 02110-1301 or visit their web page on the internet at
// http://www.fsf.org.
//
//
// CONTRIBUTION POLICY:
//
// (The following paragraph is not intended to limit the rights granted
// to you to modify and distribute this software under the terms of
// licenses that may apply to the software.)
//
// Contributions to this software are subject to your understanding and acceptance of
// the terms and conditions of the Nagios Contributor Agreement, which can be found 
// online at:
//
// http://www.nagios.com/legal/contributoragreement/
//
//
// DISCLAIMER:
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
// INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
// PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
// HOLDERS BE LIABLE FOR ANY CLAIM FOR DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
// OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
// GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, STRICT LIABILITY, TORT (INCLUDING 
// NEGLIGENCE OR OTHERWISE) OR OTHER ACTION, ARISING FROM, OUT OF OR IN CONNECTION 
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


///////////////patch submitted by Dave Worth 11/18/2010 
//add support for https 
$SERVER_BASE = isset($_SERVER['SERVER_NAME']) ? 
                      $_SERVER['SERVER_NAME'] : $_SERVER['SERVER_ADDR'];
 
$PROTO = isset($_SERVER['HTTPS']) ? 'https' : 'http';
$base = $PROTO.'://'.$SERVER_BASE;
if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
  $base .= ':'.$_SERVER['SERVER_PORT'];
}

///////////////////end patch /////////

// If necessary, adjust the path to vshell.conf, but nothing else below that
// All other setting should be adjusted by editing vshell.conf
// Switch to use external configuration file by Tony Yarusso, 30 March 2011
$ini_array = parse_ini_file('/etc/vshell.conf');

define('VERSION', '1.9.2'); 

define('LANG',$ini_array['LANG']); 

//server root information 
define('BASEURL', $base.'/'.$ini_array['BASEURL'].'/');
define('SERVERBASE', $base); //http://<address> 
define('DIRBASE', dirname(__FILE__)); //assigns current directory as root 

//nagios core locations 
define('COREURL', $base.'/'.$ini_array['COREURL'].'/'); //Nagios core web URL 
define('CORECGI', COREURL.'cgi-bin/'); //Nagios core CGI root 
define('CORECMD', CORECGI.'cmd.cgi?'); //nagios core system command cgi 

//data files for building main arrays 
define('STATUSFILE', $ini_array['STATUSFILE']); //status.dat file generated by nagios 
define('OBJECTSFILE', $ini_array['OBJECTSFILE']); //main object configuration file generated by nagios
define('CGICFG', $ini_array['CGICFG']); //cfg file with permissions cfg 

define('RESULTLIMIT', $ini_array['RESULTLIMIT']); //limits the default number for maximum results displayed in a table 

//max time to live for apc_cached data
$ttl = isset($ini_array['TTL']) ? $ini_array['TTL'] : 90; 
define('TTL', $ttl); 
 
?>
