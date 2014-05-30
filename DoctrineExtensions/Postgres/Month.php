<?php

namespace Mesd\DoctrineExtensions\DateFunctionsBundle\DoctrineExtensions\Postgres;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 *  ExtractMonthFunction ::=
 *      "MONTH" "(" ArthimeticPrimary ")"
 *
 */

class Month extends FunctionNode
{
    public $date;

    /**
     *  @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        return "extract(month from " . $sqlWalker->walkArithmeticPrimary($this->date) . ")";
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser) {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}