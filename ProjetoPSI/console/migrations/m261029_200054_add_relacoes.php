<?php

use yii\db\Migration;

class m261029_200054_add_relacoes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Relação 1 para 1 entre perfil_utilizador e user
        $this->addForeignKey('fk-perfil_utilizador-id_user', '{{%perfil_utilizador}}', 'id_user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        // Índice único para garantir a relação estrita 1 para 1 na base de dados
        $this->createIndex('idx-perfil_utilizador-id_user-unique', '{{%perfil_utilizador}}', 'id_user', true);

        // salasequipamentos -> hospitais
        $this->addForeignKey('fk-salasequipamentos-idhospitais', '{{%salasequipamentos}}', 'idhospitais', '{{%hospitais}}', 'idhospitais', 'CASCADE', 'CASCADE');

        // profissionais -> user & hospitais
        $this->addForeignKey('fk-profissionais-idutilizador', '{{%profissionais}}', 'idutilizador', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-profissionais-idhospitais', '{{%profissionais}}', 'idhospitais', '{{%hospitais}}', 'idhospitais', 'CASCADE', 'CASCADE');

        // responsaveis -> user & hospitais
        $this->addForeignKey('fk-responsaveis-idutilizador', '{{%responsaveis}}', 'idutilizador', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-responsaveis-idhospitais', '{{%responsaveis}}', 'idhospitais', '{{%hospitais}}', 'idhospitais', 'CASCADE', 'CASCADE');

        // sessoes -> user (utente), profissionais, especialidades, salasequipamentos
        $this->addForeignKey('fk-sessoes-idutente', '{{%sessoes}}', 'idutente', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-sessoes-idprofissional', '{{%sessoes}}', 'idprofissional', '{{%profissionais}}', 'idprofissional', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-sessoes-idespecialidade', '{{%sessoes}}', 'idespecialidade', '{{%especialidades}}', 'idespecialidade', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-sessoes-idsala', '{{%sessoes}}', 'idsala', '{{%salasequipamentos}}', 'idsala', 'CASCADE', 'CASCADE');

        // disponibilidades -> profissionais
        $this->addForeignKey('fk-disponibilidades-idprofissional', '{{%disponibilidades}}', 'idprofissional', '{{%profissionais}}', 'idprofissional', 'CASCADE', 'CASCADE');

        // profissional_especialidades -> profissionais & especialidades
        $this->addForeignKey('fk-prof_esp-idprofissional', '{{%profissional_especialidades}}', 'idprofissional', '{{%profissionais}}', 'idprofissional', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-prof_esp-idespecialidade', '{{%profissional_especialidades}}', 'idespecialidade', '{{%especialidades}}', 'idespecialidade', 'CASCADE', 'CASCADE');

        // sessao_materiais -> sessoes & materiais
        $this->addForeignKey('fk-sess_mat-idsessao', '{{%sessao_materiais}}', 'idsessao', '{{%sessoes}}', 'idsessao', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-sess_mat-idmaterial', '{{%sessao_materiais}}', 'idmaterial', '{{%materiais}}', 'idmaterial', 'CASCADE', 'CASCADE');

        // faturas -> user (utente)
        $this->addForeignKey('fk-faturas-idutente', '{{%faturas}}', 'idutente', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // linhasfatura -> faturas & sessoes
        $this->addForeignKey('fk-linhasfatura-idfatura', '{{%linhasfatura}}', 'idfatura', '{{%faturas}}', 'idfatura', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-linhasfatura-idsessao', '{{%linhasfatura}}', 'idsessao', '{{%sessoes}}', 'idsessao', 'CASCADE', 'CASCADE');

        // avaliacao_profissional -> sessoes
        $this->addForeignKey('fk-avaliacao-idsessao', '{{%avaliacao_profissional}}', 'idsessao', '{{%sessoes}}', 'idsessao', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-avaliacao-idsessao', '{{%avaliacao_profissional}}');
        $this->dropForeignKey('fk-linhasfatura-idsessao', '{{%linhasfatura}}');
        $this->dropForeignKey('fk-linhasfatura-idfatura', '{{%linhasfatura}}');
        $this->dropForeignKey('fk-faturas-idutente', '{{%faturas}}');
        $this->dropForeignKey('fk-sess_mat-idmaterial', '{{%sessao_materiais}}');
        $this->dropForeignKey('fk-sess_mat-idsessao', '{{%sessao_materiais}}');
        $this->dropForeignKey('fk-prof_esp-idespecialidade', '{{%profissional_especialidades}}');
        $this->dropForeignKey('fk-prof_esp-idprofissional', '{{%profissional_especialidades}}');
        $this->dropForeignKey('fk-disponibilidades-idprofissional', '{{%disponibilidades}}');
        $this->dropForeignKey('fk-sessoes-idsala', '{{%sessoes}}');
        $this->dropForeignKey('fk-sessoes-idespecialidade', '{{%sessoes}}');
        $this->dropForeignKey('fk-sessoes-idprofissional', '{{%sessoes}}');
        $this->dropForeignKey('fk-sessoes-idutente', '{{%sessoes}}');
        $this->dropForeignKey('fk-responsaveis-idhospitais', '{{%responsaveis}}');
        $this->dropForeignKey('fk-responsaveis-idutilizador', '{{%responsaveis}}');
        $this->dropForeignKey('fk-profissionais-idhospitais', '{{%profissionais}}');
        $this->dropForeignKey('fk-profissionais-idutilizador', '{{%profissionais}}');
        $this->dropForeignKey('fk-salasequipamentos-idhospitais', '{{%salasequipamentos}}');

        // Apagar primeiro a Foreign Key e só depois o Índice
        $this->dropForeignKey('fk-perfil_utilizador-id_user', '{{%perfil_utilizador}}');
        $this->dropIndex('idx-perfil_utilizador-id_user-unique', '{{%perfil_utilizador}}');
    }
}