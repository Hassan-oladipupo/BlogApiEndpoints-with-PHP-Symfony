<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725162451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE blog_post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_profile_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blog_post (id INT NOT NULL, author_id INT NOT NULL, blog_title VARCHAR(255) NOT NULL, blog_text VARCHAR(5025) NOT NULL, createdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, extra_privacy BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA5AE01DF675F31B ON blog_post (author_id)');
        $this->addSql('CREATE TABLE blog_post_user (blog_post_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(blog_post_id, user_id))');
        $this->addSql('CREATE INDEX IDX_E1B8590DA77FBEAF ON blog_post_user (blog_post_id)');
        $this->addSql('CREATE INDEX IDX_E1B8590DA76ED395 ON blog_post_user (user_id)');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, blog_id INT NOT NULL, author_id INT DEFAULT NULL, text VARCHAR(500) NOT NULL, createdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CDAE07E97 ON comment (blog_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, confirmed BOOLEAN NOT NULL, banned_untill TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE TABLE user_user (user_source INT NOT NULL, user_target INT NOT NULL, PRIMARY KEY(user_source, user_target))');
        $this->addSql('CREATE INDEX IDX_F7129A803AD8644E ON user_user (user_source)');
        $this->addSql('CREATE INDEX IDX_F7129A80233D34C1 ON user_user (user_target)');
        $this->addSql('CREATE TABLE user_profile (id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, bio VARCHAR(1024) DEFAULT NULL, website_url VARCHAR(255) DEFAULT NULL, twitter_username VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, date_of_birth DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D95AB405A76ED395 ON user_profile (user_id)');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_user ADD CONSTRAINT FK_E1B8590DA77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_user ADD CONSTRAINT FK_E1B8590DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB405A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE blog_post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_profile_id_seq CASCADE');
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT FK_BA5AE01DF675F31B');
        $this->addSql('ALTER TABLE blog_post_user DROP CONSTRAINT FK_E1B8590DA77FBEAF');
        $this->addSql('ALTER TABLE blog_post_user DROP CONSTRAINT FK_E1B8590DA76ED395');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CDAE07E97');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE user_user DROP CONSTRAINT FK_F7129A803AD8644E');
        $this->addSql('ALTER TABLE user_user DROP CONSTRAINT FK_F7129A80233D34C1');
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT FK_D95AB405A76ED395');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE blog_post_user');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('DROP TABLE user_profile');
    }
}
