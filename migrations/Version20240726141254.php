<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240726141254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        // Drop existing foreign key constraints if they exist
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT IF EXISTS fk_d95ab405a76ed395');
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT IF EXISTS fk_ba5ae01df675f31b');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT IF EXISTS fk_9474526cf675f31b');

        // Drop sequences
        $this->addSql('DROP SEQUENCE IF EXISTS user_id_seq CASCADE');

        // Create new sequence for app_user
        $this->addSql('CREATE SEQUENCE app_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        // Create app_user table
        $this->addSql('CREATE TABLE app_user (
            id INT NOT NULL, 
            username VARCHAR(180) NOT NULL, 
            first_name VARCHAR(255) NOT NULL, 
            last_name VARCHAR(255) NOT NULL, 
            roles JSON NOT NULL, 
            password VARCHAR(255) NOT NULL, 
            reset_token VARCHAR(255) DEFAULT NULL, 
            reset_token_expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
            confirmation_token VARCHAR(255) DEFAULT NULL, 
            confirmed BOOLEAN NOT NULL, 
            banned_untill TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
            PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9F85E0677 ON app_user (username)');

        // Create many-to-many relation tables
        $this->addSql('CREATE TABLE app_user_app_user (
            app_user_source INT NOT NULL, 
            app_user_target INT NOT NULL, 
            PRIMARY KEY(app_user_source, app_user_target)
        )');
        $this->addSql('CREATE INDEX IDX_F24D2A45633D42F2 ON app_user_app_user (app_user_source)');
        $this->addSql('CREATE INDEX IDX_F24D2A457AD8127D ON app_user_app_user (app_user_target)');
        $this->addSql('CREATE TABLE blog_post_app_user (
            blog_post_id INT NOT NULL, 
            app_user_id INT NOT NULL, 
            PRIMARY KEY(blog_post_id, app_user_id)
        )');
        $this->addSql('CREATE INDEX IDX_44D6B024A77FBEAF ON blog_post_app_user (blog_post_id)');
        $this->addSql('CREATE INDEX IDX_44D6B0244A3353D8 ON blog_post_app_user (app_user_id)');

        // Add new foreign key constraints
        $this->addSql('ALTER TABLE app_user_app_user 
            ADD CONSTRAINT FK_F24D2A45633D42F2 FOREIGN KEY (app_user_source) 
            REFERENCES app_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_user_app_user 
            ADD CONSTRAINT FK_F24D2A457AD8127D FOREIGN KEY (app_user_target) 
            REFERENCES app_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_app_user 
            ADD CONSTRAINT FK_44D6B024A77FBEAF FOREIGN KEY (blog_post_id) 
            REFERENCES blog_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_app_user 
            ADD CONSTRAINT FK_44D6B0244A3353D8 FOREIGN KEY (app_user_id) 
            REFERENCES app_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Drop old tables and constraints if they exist
        $this->addSql('ALTER TABLE user_user DROP CONSTRAINT IF EXISTS fk_f7129a803ad8644e');
        $this->addSql('ALTER TABLE user_user DROP CONSTRAINT IF EXISTS fk_f7129a80233d34c1');
        $this->addSql('ALTER TABLE blog_post_user DROP CONSTRAINT IF EXISTS fk_e1b8590da77fbeaf');
        $this->addSql('ALTER TABLE blog_post_user DROP CONSTRAINT IF EXISTS fk_e1b8590da76ed395');
        $this->addSql('DROP TABLE IF EXISTS user_user');
        $this->addSql('DROP TABLE IF EXISTS "user"');
        $this->addSql('DROP TABLE IF EXISTS blog_post_user');

        // Add foreign key constraints to new table
        $this->addSql('ALTER TABLE blog_post 
            ADD CONSTRAINT FK_BA5AE01DF675F31B FOREIGN KEY (author_id) 
            REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment 
            ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) 
            REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_profile 
            ADD CONSTRAINT FK_D95AB405A76ED395 FOREIGN KEY (user_id) 
            REFERENCES app_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

        // Drop new foreign key constraints
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT IF EXISTS FK_BA5AE01DF675F31B');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT IF EXISTS FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE user_profile DROP CONSTRAINT IF EXISTS FK_D95AB405A76ED395');

        // Drop sequences
        $this->addSql('DROP SEQUENCE IF EXISTS app_user_id_seq CASCADE');

        // Create old sequence for user
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');

        // Recreate old tables
        $this->addSql('CREATE TABLE user_user (
            user_source INT NOT NULL, 
            user_target INT NOT NULL, 
            PRIMARY KEY(user_source, user_target)
        )');
        $this->addSql('CREATE INDEX idx_f7129a80233d34c1 ON user_user (user_target)');
        $this->addSql('CREATE INDEX idx_f7129a803ad8644e ON user_user (user_source)');
        $this->addSql('CREATE TABLE "user" (
            id INT NOT NULL, 
            username VARCHAR(180) NOT NULL, 
            roles JSON NOT NULL, 
            password VARCHAR(255) NOT NULL, 
            confirmation_token VARCHAR(255) DEFAULT NULL, 
            confirmed BOOLEAN NOT NULL, 
            banned_untill TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
            first_name VARCHAR(255) NOT NULL, 
            last_name VARCHAR(255) NOT NULL, 
            reset_token VARCHAR(255) DEFAULT NULL, 
            reset_token_expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, 
            PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649f85e0677 ON "user" (username)');
        $this->addSql('CREATE TABLE blog_post_user (
            blog_post_id INT NOT NULL, 
            user_id INT NOT NULL, 
            PRIMARY KEY(blog_post_id, user_id)
        )');
        $this->addSql('CREATE INDEX idx_e1b8590da76ed395 ON blog_post_user (user_id)');
        $this->addSql('CREATE INDEX idx_e1b8590da77fbeaf ON blog_post_user (blog_post_id)');

        // Recreate old foreign key constraints
        $this->addSql('ALTER TABLE user_user 
            ADD CONSTRAINT fk_f7129a803ad8644e FOREIGN KEY (user_source) 
            REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_user 
            ADD CONSTRAINT fk_f7129a80233d34c1 FOREIGN KEY (user_target) 
            REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_user 
            ADD CONSTRAINT fk_e1b8590da77fbeaf FOREIGN KEY (blog_post_id) 
            REFERENCES blog_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_user 
            ADD CONSTRAINT fk_e1b8590da76ed395 FOREIGN KEY (user_id) 
            REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Drop new tables
        $this->addSql('DROP TABLE IF EXISTS app_user');
        $this->addSql('DROP TABLE IF EXISTS app_user_app_user');
        $this->addSql('DROP TABLE IF EXISTS blog_post_app_user');

        // Recreate old foreign key constraints
        $this->addSql('ALTER TABLE user_profile 
            ADD CONSTRAINT fk_d95ab405a76ed395 FOREIGN KEY (user_id) 
            REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post 
            ADD CONSTRAINT fk_ba5ae01df675f31b FOREIGN KEY (author_id) 
            REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment 
            ADD CONSTRAINT fk_9474526cf675f31b FOREIGN KEY (author_id) 
            REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
