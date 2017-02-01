<?php
set_include_path("../");
require("Calculate.php");

class CalculateTest extends PHPUnit_Framework_TestCase {
    
    private $calClass;

    protected static function callMethod($obj, $name, array $args) 
    {
        $class  = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, $args);
    }

    protected function setUp() 
    {
        $this->calClass  = new Calculate();
        parent::setUp();
    }

    public function testSumValidateOK()
    {
        //create class
        $calClass = $this->getMockBuilder('Calculate')
                        ->setMethods(['checkType'])
                        ->getMock();

        $calClass->method('checkType')
                  ->willReturn(true);

        $result = $calClass->sum(2, 3);

        $this->assertEquals(5, $result);
        $this->assertInternalType('int', $result);
    }

    public function testSumValidateFail()
    {
        //create class
        $calClass = $this->getMockBuilder('Calculate')
                        ->setMethods(['checkType'])
                        ->getMock();

        $calClass->method('checkType')
                  ->willReturn(false);

        $result = $calClass->sum(2, 3);

        $this->assertNull($result);
    }

    public function testCheckTypeInteger()
    {
        $result = $this->callMethod(
            $this->calClass,
            "checkType",
            [2, "int"]
        );

        $this->assertTrue($result);
    }

    public function testCheckTypeNotInteger()
    {
        $result = $this->callMethod(
            $this->calClass,
            "checkType",
            ["2", "int"]
        );

        $this->assertFalse($result);
    }

    //---------Start: Divine----------
    public function testDivineValidateFail()
    {
        //create class
        $calClass = $this->getMockBuilder('Calculate')
                        ->setMethods(['checkType'])
                        ->getMock();

        $calClass->method('checkType')
                  ->willReturn(false);

        $result = $calClass->divine(7, 4);

        $this->assertNull($result);
    }

    public function testDivineValidateOKButValue2IsZero()
    {
        //create class
        $calClass = $this->getMockBuilder('Calculate')
                        ->setMethods(['checkType'])
                        ->getMock();

        $calClass->method('checkType')
                  ->willReturn(true);

        $result = $calClass->divine(7, 0);

        $this->assertNull($result);
    }

    public function testDivineValidateOKAndSuccess()
    {
        //create class
        $calClass = $this->getMockBuilder('Calculate')
                        ->setMethods(['checkType'])
                        ->getMock();

        $calClass->method('checkType')
                  ->willReturn(true);

        $result = $calClass->divine(7, 4);

        $this->assertNotNull($result);
        $this->assertInternalType('float', $result);
        $this->assertEquals($result, 1.75);
    }
    //---------End: Divine----------

}