<?php

declare(strict_types=1);

namespace JGabrielrc\DoctrineCourse\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515213321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE courses_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE phones_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE students_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE courses (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A9A55A4C5E237E06 ON courses (name)');
        $this->addSql('CREATE TABLE phones (id INT NOT NULL, student_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E3282EF5CB944F1A ON phones (student_id)');
        $this->addSql('CREATE TABLE students (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE student_course (student_id INT NOT NULL, course_id INT NOT NULL, PRIMARY KEY(student_id, course_id))');
        $this->addSql('CREATE INDEX IDX_98A8B739CB944F1A ON student_course (student_id)');
        $this->addSql('CREATE INDEX IDX_98A8B739591CC992 ON student_course (course_id)');
        $this->addSql('ALTER TABLE phones ADD CONSTRAINT FK_E3282EF5CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student_course ADD CONSTRAINT FK_98A8B739CB944F1A FOREIGN KEY (student_id) REFERENCES students (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student_course ADD CONSTRAINT FK_98A8B739591CC992 FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE courses_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE phones_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE students_id_seq CASCADE');
        $this->addSql('ALTER TABLE phones DROP CONSTRAINT FK_E3282EF5CB944F1A');
        $this->addSql('ALTER TABLE student_course DROP CONSTRAINT FK_98A8B739CB944F1A');
        $this->addSql('ALTER TABLE student_course DROP CONSTRAINT FK_98A8B739591CC992');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE phones');
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE student_course');
    }
}
