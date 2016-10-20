<?php

namespace Miniplayer\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('deezer', 'text')
            ->add('image', 'text');        
    }

    public function getName()
    {
        return 'playlist';
    }
}