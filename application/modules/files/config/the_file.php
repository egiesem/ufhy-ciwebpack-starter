<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['file_path'] = FCPATH . '..' . DIRECTORY_SEPARATOR . 'uploads/files';

$config['file_encrypt_filename'] = true;

$config['file_allowed_file_ext'] = array(
    'a'	=> array('mpga', 'mp2', 'mp3', 'ra', 'rv', 'wav'),
    'v'	=> array('mpeg', 'mpg', 'mpe', 'mp4', 'flv', 'qt', 'mov', 'avi', 'movie'),
    'd'	=> array('pdf', 'xls', 'ppt', 'pptx', 'txt', 'text', 'log', 'rtx', 'rtf', 'xml', 'xsl', 'doc', 'docx', 'xlsx', 'word', 'xl', 'csv'),
    'i'	=> array('bmp', 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'tiff', 'tif'),
    'o'	=> array('psd', 'gtar', 'swf', 'tar', 'tgz', 'xhtml', 'zip', 'css', 'html', 'htm', 'shtml', 'svg'),
);
