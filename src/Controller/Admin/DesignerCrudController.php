<?php

namespace App\Controller\Admin;

use App\Entity\Designer;
<<<<<<< HEAD
=======
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
>>>>>>> b29129fec2eb1b2fe4c98912b5d9c2ec6c3e5eb1
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DesignerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Designer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
<<<<<<< HEAD
            ImageField::new('image')
                ->setBasePath('uploads/designers')
                ->setUploadDir('public/uploads/designers')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
=======
            SlugField::new('slug')->setTargetFieldName('name'),
            ImageField::new('image')->setUploadDir('public/assets/img')
>>>>>>> b29129fec2eb1b2fe4c98912b5d9c2ec6c3e5eb1
        ];
    }
}
