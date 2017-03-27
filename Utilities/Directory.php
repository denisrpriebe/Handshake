<?php

namespace IrishTitan\Handshake\Utilities;

class Directory
{

    /**
     * Deletes the given directory and everything in it.
     *
     * @param $dir
     */
    public static function remove($dir)
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
    public static function make($dir)
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
    }

}