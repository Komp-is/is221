<?php 
namespace App\Services;

class FileStorage implements ILoadStorage, ISaveStorage
{
    public function loadData(string $name): ?array
    {
        if (!file_exists($name)) {
            return [];
        }

        $handle = fopen($name, "r");
        if ($handle === false) {
            return [];
        }

        $size = filesize($name);
        $data = ($size > 0) ? fread($handle, $size) : '';
        fclose($handle);

        if ($data === '' || $data === false) {
            return [];
        }

        $arr = json_decode($data, true);
        return is_array($arr) ? $arr : [];
    }

    public function saveData(string $name, array $arr): bool
    {
        if (!file_exists($name)) {
            file_put_contents($name, "[]");
        }

        $handle = fopen($name, "r");
        if ($handle === false) {
            return false;
        }
        if (filesize($name) > 0){ 
            $data = fread($handle, filesize($name)); 
            $allRecords = json_decode($data, true); 
        } else {
            $allRecords = [];
        }
        fclose($handle);
        if (!is_array($allRecords)) {
            $allRecords = [];
        }

        $allRecords[]= $arr;
        $json = json_encode($allRecords, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $handle = fopen($name, "w");
        if ($handle === false) {
            return false;
        }
        fwrite($handle, $json);
        fclose($handle);

        return true;
    }
}
