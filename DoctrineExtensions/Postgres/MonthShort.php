<?php

namespace Mesd\DoctrineExtensions\DateFunctionsBundle\DoctrineExtensions\Postgres;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

/**
 *  ExtractMonthFunction ::=
 *      "MONTH" "(" ArthimeticPrimary ")"
 *
 */

class MonthShort extends FunctionNode
{
    public $date;

    /**
     *  @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return "to_char(" . $sqlWalker->walkArithmeticPrimary($this->date) . ", 'Mon')";
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
