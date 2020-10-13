<?php

declare(strict_types=1);

namespace SelecaoGlobo\Unit\Mocks\BFF\Desktop\Domain\ValueObject;

use Prophecy\Prophecy\ObjectProphecy;
use SelecaoGlobo\BFF\Desktop\Domain\ValueObject\Stadium;
use SelecaoGlobo\Unit\Mocks\AbstractMock;

/**
 * Class StadiumMock
 */
class StadiumMock extends AbstractMock
{
    /**
     * @return ObjectProphecy
     */
    public function getMock(): ObjectProphecy
    {
        return $this->prophesize(Stadium::class);
    }

    /**
     * @return Stadium
     */
    public function getObjectWithMockDependencies(): Stadium
    {
        return new Stadium(
            277,
            'Estádio Jornalista Mário Filho',
            'Maracanã',
            [
                'tipo_id'   => '1',
                'descricao' => 'Arena Desportiva',
            ]
        );
    }
}
