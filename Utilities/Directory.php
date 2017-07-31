<?php

namespace IrishTitan\Handshake\Utilities;

use Magento\Framework\App\Filesystem\DirectoryList;

class Directory
{

    /**
     * The directory list instance.
     *
     * @var mixed
     */
    protected $directoryList;

    /**
     * Directory constructor.
     *
     * @param DirectoryList $directoryList
     */
    public function __construct(DirectoryList $directoryList)
    {
        $this->directoryList = $directoryList;
    }

    /**
     * Deletes the given directory and everything in it.
     *
     * @param $dir
     */
    public function remove($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        static::remove($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    /**
     * Creates the given directory.
     *
     * @param $dir
     */
    public function make($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
    }

    /**
     * Get all directories in the given directories.
     *
     * @param $directory
     * @return \Illuminate\Support\Collection
     */
    public function directories($directory)
    {
        $directories = collect();

        foreach (glob($directory . "*") as $file) {
            is_dir($file) ?: $directories->push($file);
        }

        return $directories;
    }

    /**
     * Get the path to the app directory.
     *
     * @return mixed
     */
    public
    function app()
    {
        return $this->directoryList->getPath('app');
    }

}