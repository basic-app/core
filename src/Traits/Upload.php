<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 */
namespace BasicApp\Core\Traits;

use CodeIgniter\HTTP\Files\UploadedFile;

trait Upload
{
    public function upload(UploadedFile $file, ?string $folderName = null)
    {
        $folderName = rtrim($folderName ?? date('Ymd'), '/') . '/';

        $filename = $file->getRandomName();

        $file->move(FCPATH . $folderName, $filename);

        return $folderName . $filename;
    }
}