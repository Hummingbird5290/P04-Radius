<?php /*
ตัวอย่างการใช้งาน Bench_Mark
 
$val = range( '0' , '1000' ); // แอเรย์ที่กำหนด

$a = '';
$bm = new Timer; // เรียกใช้งาน class
$bm->start(); // เริ่มต้นจับเวลา
// ประมวลผลการทดสอบ
for( $i = 0 ; $i < count($val) ; $i++ )
{
    $a .= $val[$i];
}
echo $bm->stop(); // แสดงเวลาที่ใช้ไป
*/
class Timer{
    private $elapsedTime;

    // start timer
    public function start()
    {
        if( !$this->elapsedTime = $this->getMicrotime() )
        {
            throw new Exception( 'Error obtaining start time!' );
        };
    }

    // stop timer
    public function stop()
    {
        if( !$this->elapsedTime = round( $this->getMicrotime() - $this->elapsedTime , 10 ) )
        {
            throw new Exception( 'Error obtaining stop time!' );
        };
        return $this->elapsedTime;
    }

    // define private 'getMicrotime()' method
    private function getMicrotime()
    {
        list( $useg , $seg ) = explode( ' ' , microtime() );
        return ( (float)$useg + (float)$seg );
    }
};
?>