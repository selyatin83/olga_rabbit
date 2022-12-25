<?php

declare(strict_types=1);

namespace omarinina\application\services\image;

class AdImageDeleteService
{

    public static function deleteAdImages(array $imagePaths): void
    {
        foreach ($imagePaths as $imagePath) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
}