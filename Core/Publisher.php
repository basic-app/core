<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core;

use CodeIgniter\Publisher\Publisher as BasePublisher;
use CodeIgniter\HTTP\URI;
use ZipArchive;
use Config\Publisher as PublisherConfig;

class Publisher extends BasePublisher
{

    public $allowedTypes = [];

    public $allowedFiles = [];

    public $createDestination = false;

    public $curlOptions = [];

    public function __construct(?string $source = null, ?string $destination = null)
    {        
        if ($this->createDestination)
        {
            $this->createDirectory($this->destination);
        }

        $config = config(PublisherConfig::class);

        $originalRestrictions = $config->restrictions[FCPATH];

        if ($this->allowedFiles)
        {
            $config->restrictions[FCPATH] = str_replace(
                '#\.', 
                '#' . implode('|', $this->allowedFiles) . '|\.', 
                $config->restrictions[FCPATH]
            );
        }

        if ($this->allowedTypes)
        {
            $config->restrictions[FCPATH] = str_replace(
                ')$#', 
                '|' . implode('|', $this->allowedTypes) . ')$#', 
                $config->restrictions[FCPATH]
            );
        }

        parent::__construct($source, $destination);

        $config->restrictions[FCPATH] = $originalRestrictions;
    }

    public function createDirectory($path)
    {
        if ($path && !is_dir($path))
        {
            mkdir($path, 0755, true);
        }

        return $this;
    }

    public function downloadFile($url, $target = null, array $curlOptions = [], &$result = null)
    {
        if ($target === null)
        {
            $target = $this->getScratch() . basename((new URI($url))->getPath());
        }

        $ch = curl_init($url);

        if ($target)
        {
            $fp = fopen($target, "w");

            if ($fp === false)
            {
                throw new FileException('Open file error: ' . $target);
            }

            $curlOptions[CURLOPT_FILE] = $fp;
        }

        $defaultCurlOptions = [
            CURLOPT_HEADER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
        ];

        curl_setopt_array($ch, $defaultCurlOptions + $this->curlOptions + $curlOptions);

        $result = curl_exec($ch);

        if ($result === false)
        {
            $error = curl_error($ch);
        }

        curl_close($ch);

        if ($target)
        {
            if (fclose($fp) === false)
            {    
                throw new FileException('Close file error: ' . $target);
            }
        }

        if ($result === false)
        {
            throw new CurlException($error);
        }

        return $this;
    }

    public function extractZipArchive(string $filename, $targetPath = null, $files = null)
    {
        if ($targetPath === null)
        {
            $targetPath = $this->getScratch();
        }

        if (!is_file($filename))
        {
            throw new FileException('File not found: ' . $filename);
        }

        $zip = new ZipArchive;
        
        $res = $zip->open($filename);
        
        if ($res !== true)
        {
            throw new ZipException('Open zip error: ' . $filename);
        }

        if (!$zip->extractTo($targetPath, $files))
        {
            throw new ZipException('Extract zip error: ' . $filename);
        }
        
        if (!$zip->close())
        {
            throw new ZipException('Close zip error: ' . $filename);
        }

        return $this;
    }

    public function setSource(string $path)
    {
        $this->source = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

        return $this;
    }
    
}