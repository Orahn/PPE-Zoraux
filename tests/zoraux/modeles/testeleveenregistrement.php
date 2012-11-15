<?php


class Tests_Zoraux_Modeles_TestEleveEnregistrement extends PHPUnit_Framework_TestCase {

	function setUp() {
		
	}

	function tearDown() {
		
	}

	function testClasse() {
            $tableEleves = new Zoraux_Modeles_Eleve();
            $eleve = $tableEleves->get(3);
            var_dump($eleve);
            $this -> assertEquals(2, $eleve -> getClasse() -> id);
        }
}
