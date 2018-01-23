<?php
class ImagesDB{

    private $dataBaseConnect,
            $tableValues,
            $tableData,
            $imgFileData;

    public function __construct(mysqli $connectData){
        $this->dataBaseConnect = $connectData;
        $this->imgFileData = key($_FILES);
    }

    private function checkImageData(){
        $uploadError = [
            1 => 'Error. The maximum file size specified in php.ini is exceeded',
            2 => 'Error. The maximum file size specified in the HTML form has been exceeded',
            3 => 'Error. Only part of the file was sent',
            4 => 'Error. File to send was not selected'
        ];

        if(!($_FILES[$this->imgFileData]['error'])){

            if(getimagesize($_FILES[$this->imgFileData]['tmp_name'])){
                return TRUE;
            }else{
                echo "File {$_FILES[$this->imgFileData]['tmp_name']} not image!";
                return FALSE;
            }
        }else{
            echo $uploadError[$_FILES[$this->imgFileData]['error']];
            return FALSE;
        }
    }

    private function setTableValue(){
        $queryResult = $this->dataBaseConnect->query('DESC ' . IMG_TABLE);

        foreach ($queryResult as $arrayData)
            $this->tableValues[] = $arrayData['Field'];
    }

    private function setTableData(){
        $imageInfo = getimagesize($_FILES[$this->imgFileData]['tmp_name']);

        $this->tableData = [
            'imageName' => $_FILES[$this->imgFileData]['name'],
            'mimeType'  => end($imageInfo),
            'imageSize' => $_FILES[$this->imgFileData]['size'],
            'imageData' => file_get_contents($_FILES[$this->imgFileData]['tmp_name'])
        ];
    }

    private function showImageFromDB(){
        header('Content-type: ' . $this->tableData['mimeType']);
        header('Content-length: ' . $this->tableData['imageSize']);
        echo $this->tableData['imageData'];
    }

    public function addImageToDB(){

        if($this->checkImageData()){

            $this->setTableValue();
            $this->setTableData();

            $query =  sprintf("INSERT INTO " . IMG_TABLE . "
                ({$this->tableValues[1]}, {$this->tableValues[2]}, {$this->tableValues[3]}, {$this->tableValues[4]})
              VALUES
                ('%s', '%s', %d, '%s');",
                $this->tableData['imageName'], $this->dataBaseConnect->real_escape_string($this->tableData['mimeType']),
                $this->tableData['imageSize'], $this->dataBaseConnect->real_escape_string($this->tableData['imageData']));

            if(!($this->dataBaseConnect->query($query)))
                echo "ERROR " . $this->dataBaseConnect->error;
            else
                $this->showImageFromDB();

        } else
            exit();
    }
}