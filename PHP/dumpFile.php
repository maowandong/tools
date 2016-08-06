<?php
/**
 * 导出文件，需要区分是mac还是window操作系统
 *
 * Created by PhpStorm.
 * User: windyman
 * Date: 2016/8/6
 * Time: 10:13
 */


/**
 * @param $fileName    导出的文件名
 * @param $data        导出的数据, 按照excel里面一行一行摆放好；
 *              如  '序号，日期，姓名，年龄' . '\n' . '1' . '2016-07-29' . 'windyaman' . '19'
 *
 * 返回的数据直接echo到浏览器里面即可
 */
function downLoadCSVInfo($fileName, $data){

    if(strpos($_SERVER['HTTP_USER_AGENT'],'Mac OS')){
        $filename = $fileName . '.xls';
        header("Content-type:application/vnd.ms-excel;charset=gbk");
        header("Content-Disposition:attachment;filename=".$filename);
        $data = str_replace("\t","'",$data);
        $data = str_replace(',',"\t",$data);
        $data = iconv( 'UTF-8' , 'GBK' , $data);
    }else{
        $filename =  $fileName . '.csv';
        $filenames= strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') ? urlencode($filename) : $filename;
        header("Content-type: text/html; charset=utf-8");
        header('Content-Encoding: none');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Pragma: no-cache');
        header('Expires: 0');
        $data = iconv( 'UTF-8' , 'GBK' , $data);
        //$data = chr(239).chr(187).chr(191).$data;
    }

    echo $data;
}

