<?php


namespace App\Core\Facades;


use Illuminate\Contracts\Filesystem\Filesystem;

class Uploads extends \Illuminate\Support\Facades\Storage
{
    /**
     * Returns an instance of FileSystem for private disk.
     * @return Filesystem
     */
    public static function instance(): Filesystem
    {
        return \Illuminate\Support\Facades\Storage::disk('private');
    }

    /**
     * Deletes a file if it exists.
     * @param string|null $path
     */
    public static function deleteIfExists(string $path = null): void
    {
        if (self::instance()->exists($path))
            self::instance()->delete($path);
    }

    /**
     * Returns the path of a file if it exists, null otherwise.
     * @param string|null $path
     * @param string|null $default
     * @return string|null
     */
    public static function existsUrl(?string $path = null, ?string $default = null): ?string
    {
        if (self::instance()->exists($path))
            return self::instance()->url($path);
        else
            return $default;
    }
}