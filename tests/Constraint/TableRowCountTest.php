<?php
/*
 * This file is part of DbUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Windstep\DbUnit\Constraint\TableRowCount;
use Windstep\Framework\ExpectationFailedException;
use Windstep\Framework\TestCase;

class Extensions_Database_Constraint_TableRowCountTest extends TestCase
{
    public function testConstraint(): void
    {
        $constraint = new TableRowCount('name', 42);

        $this->assertTrue($constraint->evaluate(42, '', true));
        $this->assertFalse($constraint->evaluate(24, '', true));
        $this->assertEquals('is equal to expected row count 42', $constraint->toString());

        try {
            $this->assertThat(24, $constraint, '');
        } catch (ExpectationFailedException $e) {
            $this->assertEquals(
                'Failed asserting that 24 is equal to expected row count 42.',
                $e->getMessage()
            );
        }
    }
}
