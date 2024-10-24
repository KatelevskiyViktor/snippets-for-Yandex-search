<?php


class Thumbnail
{
    const RootDir = __DIR__ . '/../arts';
    public function __construct()
    {

        // получаем все файлы в папке

        $files = new DirectoryIterator(self::RootDir);

        // проходимся по ним
        foreach ($files as $file)
        {
            // если файл - . или .. - пропускаем
            if ($file->isDot() || file_exists(__DIR__ . '/../arts/thumbnail/' . substr($file->getFilename(), 0, -4).'.jpg'))
                continue;


            // получаем полный путь к файлу
            $filePath = self::RootDir . '/' . $file->getFilename();


            if ($file->isFile() && $file->getExtension() === 'pdf')
            {
                $posterFile = new SplFileInfo($this->coverImagePath($filePath));
                if ($posterFile->isFile()) continue;

                $this->createPoster($filePath);
            }
        }
    }

    // путь к файлам с превью
    function coverImagePath(string $pdfFileName)
    {
        $poster = pathinfo($pdfFileName, PATHINFO_FILENAME);
        return self::RootDir . "/thumbnail/$poster.jpg";
    }


// здесь создаем превью
// параметр файла - пусть к PDF-файлу
    function createPoster(string $pdfFile)
    {
        $pdfFile = $pdfFile.'[0]'; // первая страница
        $im = new Imagick($pdfFile); // читаем первую страницу из файла
        $im->setImageFormat('jpg'); // устанавливаем формат jpg
        file_put_contents($this->coverImagePath($pdfFile), $im); // сохраняем файл в папку
        $im->clear(); // очищаем используемые ресурсы
    }



}