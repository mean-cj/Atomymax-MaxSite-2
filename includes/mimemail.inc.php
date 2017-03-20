<?
/*
 +-------------------------------------------------------------------+
 |                     M I M E M A I L   (v1.5)                      |
 |                                                                   |
 | Copyright Gerd Tentler               www.gerd-tentler.de/tools    |
 | Created: Nov. 2, 2004                Last modified: Oct. 19, 2005 |
 +-------------------------------------------------------------------+
 | This program may be used and hosted free of charge by anyone for  |
 | personal purpose as long as this copyright notice remains intact. |
 |                                                                   |
 | Obtain permission before selling the code for this program or     |
 | hosting this software on a commercial website or redistributing   |
 | this software over the Internet or in any other medium. In all    |
 | cases copyright must remain intact.                               |
 +-------------------------------------------------------------------+

==========================================================================================================
 This script can send MIME-mails with attachments. It uses the PHP mail-function.

 EXAMPLE:

 $mail = new MIMEMAIL("HTML");

 $mail->senderName = "sender name";
 $mail->senderMail = "sender@email";
 $mail->bcc = "bcc@email";

 $mail->subject = "This is the subject line";

 $mail->body = "Hello! This is a message for you.";   // OR: $mail->body = "path_to_file/filename";

 $mail->attachment[] = "path_to_file1/filename1";
 $mail->attachment[] = "path_to_file2/filename2";
 ...

 $mail->create();

 $mail->send("recipient1@email");
 $mail->send("recipient2@email,recipient3@email,recipient4@email");
 ...
==========================================================================================================
*/
  error_reporting(E_WARNING);

  class MIMEMAIL {
//--------------------------------------------------------------------------------------------------------
// Configuration
//--------------------------------------------------------------------------------------------------------
    var $type = 'Text';             // e-mail type ("HTML" or "Text")
    var $senderName = '';           // sender name
    var $senderMail = '';           // sender e-mail address
    var $cc = '';                   // Cc (e-mail address)
    var $bcc = '';                  // Bcc (e-mail address)
    var $documentRoot = '';         // document root (path to images, stylesheets, etc.)
    var $saveDir = '';              // save e-mail to this directory (do not send) => just for testing :)
//    var $charSet = 'ISO-8859-1';    // character set (ISO)
    var $charSet = 'UTF-8';   
    var $useQueue = false;          // use mail queue (true = yes, false = no) => does not work with PHP
                                    // versions < 4.0.5, or with versions >= 4.2.3 in Safe Mode, or with
                                    // MTAs other than sendmail!

    var $mime = array('jpg'  => 'image/jpeg',
                      'jpeg' => 'image/jpeg',
                      'gif'  => 'image/gif',
                      'png'  => 'image/png',
                      'swf'  => 'application/x-shockwave-flash',
                      'doc'  => 'application/msword',
                      'xls'  => 'application/msexcel',
                      'ppt'  => 'application/mspowerpoint',
                      'pdf'  => 'application/pdf',
                      'zip'  => 'application/zip',
                      'rtf'  => 'text/rtf',
                      'rtx'  => 'text/richtext',
                      'txt'  => 'text/plain',
                      'js'   => 'text/javascript',
                      'css'  => 'text/css');

    var $exclude = array('htm', 'php', 'pl', 'prl', 'cgi');
    var $inline = array();
    var $attachment = array();
    var $subject, $body, $header, $footer;

//--------------------------------------------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------------------------------------------
    function MIMEMAIL($type = '') {
      if($type) $this->type = $type;
    }

    function get_img_type($data) {
      $abc = substr($data, 0, 20);
      if(strstr($abc, 'GIF')) $ftype = 'gif';
      else if(strstr($abc, 'JFIF') || strstr($abc, 'Exif')) $ftype = 'jpeg';
      else if(strstr($abc, 'PNG')) $ftype = 'png';
      else if(strstr($abc, 'FWS') || strstr($abc, 'CWS')) $ftype = 'swf';
      else $ftype = '';

      return $ftype;
    }

    function get_img_data($html, $m, $css) {
      global $HTTP_HOST;

      $host = 'http://' . preg_replace('/\$/i', '', $HTTP_HOST);

      for($i = 0; $i < count($m[0]); $i++) {
        $ftype = $data = $ext = $fname = '';

        if(!preg_match('/^(http|ftp|mailto|javascript)/i', $m[2][$i])) {
          $inlName = $m[2][$i];
          $ext = substr($inlName, strrpos($inlName, '.') + 1);
          $incl = true;

          for($j = 0; $j < count($this->exclude) && $incl; $j++) {
            if(stristr($ext, $this->exclude[$j])) $incl = false;
          }

          if($incl) {
            if($this->documentRoot) {
              $doc_root = $this->documentRoot;

              while(preg_match('/^\.\./i', $inlName)) {
                $inlName = substr($inlName, 3);
                $doc_root = preg_replace('/\[^/\]+$/i', '', $doc_root);
              }
              $fname = "$doc_root/$inlName";
            }
            else $fname = $inlName;

            if($fp = @fopen($fname, 'rb')) {
              $data = fread($fp, @filesize($fname));
              fclose($fp);
            }
          }
        }

        if($data) {
          if(!$ext) $ftype = $this->get_img_type($data);
          else $ftype = $ext;

          if($css) $html = str_replace($m[0][$i], ' ' . $m[1][$i] . '(cid:' . $inlName . ')', $html);
          else $html = str_replace($m[0][$i], ' ' . $m[1][$i] . '="cid:' . $inlName . '"', $html);

          if(!$this->inline[$ftype][$inlName]) {
            $this->inline[$ftype][$inlName] = chunk_split(base64_encode($data));
          }
        }
        else if(!preg_match('/^(http|ftp|mailto|javascript)/i', $m[2][$i])) {
          if($css) $html = str_replace($m[0][$i], ' ' . $m[1][$i] . "($host/$inlName)", $html);
          else $html = str_replace($m[0][$i], ' ' . $m[1][$i] . "=\"$host/$inlName\"", $html);
        }
      }
      return $html;
    }

    function check_body() {
      if(preg_match_all('/ (src|background|href)="?([^" >]+)"?/i', $this->body, $m))
        $this->body = $this->get_img_data($this->body, $m, false);
      if(preg_match_all('/ (url)\(([^\)]+)\)/i', $this->body, $m))
        $this->body = $this->get_img_data($this->body, $m, true);

      $this->body = preg_replace("/<(table|tr|div)([^>]*)>\r?\n?/i", "<\\1\\2>\r\n", $this->body);
      $this->body = preg_replace("/<\/(table|tr|td|style|script|div|p)>\r?\n?/i", "</\\1>\r\n", $this->body);
    }

    function prepare() {
      $attachments = $filetype = array();

      if(count($this->attachment)) while(list(, $att) = each($this->attachment)) {
        if($att && $att != 'none') {
          if($fp = @fopen($att, 'rb')) {
            $filename = basename(str_replace('\\', '/', $att));
            $file = fread($fp, @filesize($att));
            fclose($fp);

            $ext = substr($filename, strrpos($filename, '.')+1);
            $filetype[$filename] = $this->mime[$ext] ? $this->mime[$ext] : 'application/octet-stream';
            $attachments[$filename] = chunk_split(base64_encode($file));
          }
        }
      }

      $this->header = $this->footer = '';
      $uid1 = 'Next_' . strtoupper(md5(uniqid(time()) . 1));
      $uid2 = 'Next_' . strtoupper(md5(uniqid(time()) . 2));

      $this->header .= "Return-Path: " . $this->senderMail . "\n" .
                       "Subject:\n" .
                       "From: " . $this->senderName . " <" . $this->senderMail . ">\n" .
                       "X-Sender: <" . $this->senderMail . ">\n" .
                       "X-Mailer: PHP " . phpversion() . "\n" .
                       "MIME-Version: 1.0\n";

      if($this->cc) $this->header .= "Cc: " . $this->cc . "\n";
      if($this->bcc) $this->header .= "Bcc: " . $this->bcc . "\n";

      if($this->type == 'HTML' || count($attachments)) {
        $this->header .= "Content-Type: multipart/mixed;\n\t" .
                         "boundary=\"$uid1\"\n\n" .
                         "This is a multi-part message in MIME format.\n\n" .
                         "--$uid1\n";
      }

      if($this->type == 'HTML') {
        $this->header .= "Content-Type: multipart/related;\n\t" .
                         "boundary=\"$uid2\"\n\n" .
                         "--$uid2\n";
      }

      $this->header .= "Content-Type: text/" . (($this->type == 'HTML') ? 'html' : 'plain') . ";\n\t" .
                       "charset=\"" . $this->charSet . "\"\n" .
                       "Content-Transfer-Encoding: 8bit\n\n";

      if($this->type == 'HTML') {
        if(count($this->inline)) while(list($ftype, $arr) = each($this->inline)) {
          if(count($arr)) while(list($inlName, $data) = each($arr)) {
            $inlType = $this->mime[$ftype] ? $this->mime[$ftype] : 'application/octet-stream';
            $this->footer .= "--$uid2\n" .
                             "Content-Type: $inlType;\n\t" .
                             "name=\"$inlName\"\n" .
                             "Content-ID: <$inlName>\n" .
                             "Content-Disposition: inline;\n\t" .
                             "filename=\"$inlName\"\n" .
                             "Content-Transfer-Encoding: base64\n\n" .
                             "$data\n\n";
          }
        }
        $this->footer .= "--$uid2--\n\n";
      }

      if(count($attachments)) while(list($filename, $file) = each($attachments)) {
        $this->footer .= "--$uid1\n" .
                         'Content-Type: ' . $filetype[$filename] . ";\n\t" .
                         "name=\"$filename\"\n" .
                         "Content-Disposition: attachment;\n\t" .
                         "filename=\"$filename\"\n" .
                         "Content-Transfer-Encoding: base64\n\n" .
                         "$file\n\n";
      }

      if($this->type == 'HTML' || $file) $this->footer .= "--$uid1--";
    }

    function send($email) {
      if($this->saveDir) $this->header = str_replace("Subject:\n", 'Subject: ' . $this->subject . "\n", $this->header);
      else $this->header = str_replace("Subject:\n", '', $this->header);

      $mime_mail = $this->header . $this->body . "\n\n" . $this->footer;

      if($this->saveDir) {
        if($fp = @fopen($this->saveDir . '/mail.eml', 'w')) {
          $mime_mail = "To: $email\n" . $mime_mail;
          fwrite($fp, $mime_mail, strlen($mime_mail));
          fclose($fp);
          $ok = true;
        }
        else $ok = false;
      }
      else {
        $php_ver = phpversion();
        if(function_exists('ini_get')) $safe_mode = ini_get('safe_mode');
        else $safe_mode = get_cfg_var('safe_mode');

        if($php_ver < '4.0.5' || ($php_ver >= '4.2.3' && $safe_mode)) {
          $ok = @mail($email, $this->subject, '', $mime_mail);
        }
        else {
          $options = ($this->useQueue ? '-odq ' : '') . '-i -f ' . $this->senderMail;
          $ok = @mail($email, $this->subject, '', $mime_mail, $options);
        }
      }

      return $ok;
    }

    function create() {
      if(strlen($this->body) < 100) {
        $file = str_replace('\\', '/', $this->body);

        if($fp = @fopen($file, 'r')) {
          $this->body = fread($fp, @filesize($file));
          fclose($fp);
          $this->documentRoot= dirname($file);
        }
      }
      if($this->type == 'HTML') $this->check_body();
      $this->prepare();
    }
  }
?>
