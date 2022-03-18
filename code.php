<?php
interface Human
{
    public function eatFood(): void;

    public function drinkWater(): void;
}

abstract class Client
{
    abstract function DepositCash(int $money): void;

    public function printWelcomeMessage(): void
    {
        print("Теперь вы можете пополнить счет, а потом снова поволнить счет ;)\n");
    }
}

class User extends Client implements Human
{
    const IsAdmin = false;
    const GroupName = "Default";

    private static int $totalCash = 0;

    private readonly string $name;
    private int $cash;
    private int $happy = 50;


    function __construct(string $name, int $money)
    {
        $this->name = $name;
        $this->cash = $money;
        self::$totalCash+=$money;
        print("Новый пользователь " . $this->name . ". Счет: " . $this->cash . "\n");
        print("Общий счет всех пользователей: " . self::$totalCash . "\n");
    }
    function __destruct()
    {
        self::$totalCash -= $this->cash;
        print($this->name . " deleted\n");
        print("Общий счет всех пользователей: " . self::$totalCash . "\n");
    }


    public function getName(): string
    {
        return $this->name;
    }
    public function getCash(): int
    {
        return $this->cash;
    }


    public function eatFood(): void
    {
        print($this->name . " покушал\n");
        $this->happy+=10;
    }
    public function drinkWater(): void
    {
        print($this->name . " попил воды\n");
        $this->happy+=10;
    }
    function DepositCash(int $money): void
    {
        $this->cash+=$money;
        $this->happy-=15;
        self::$totalCash+=$money;
        print($this->name . " пополнил счет(всего " . $this->cash .")\n");
    }
}

$pepe = new User("Pepe", 100);
$pepe->eatFood();
$pepe->drinkWater();
$pepe->DepositCash(100);
$frog = new User("Frog", 50);
$frog->drinkWater();
