<?php declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210424123834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("create table storage
                        (
                            `key` varchar(200) not null
                                primary key,
                            value text         null
                        );
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("drop table storage");
    }
}
