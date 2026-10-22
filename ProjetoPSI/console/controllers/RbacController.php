<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Controller para inicialização do RBAC do Yii2
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Limpa todas as permissões e papéis anteriores
        $auth->removeAll();

        // ==========================================
        // 1. CRIAR PERMISSÕES
        // ==========================================

        // Permissões de Utilizadores
        $criarUtilizador = $auth->createPermission('criarUtilizador');
        $criarUtilizador->description = 'Criar Utilizador';
        $auth->add($criarUtilizador);

        $visualizarUtilizador = $auth->createPermission('visualizarUtilizador');
        $visualizarUtilizador->description = 'Visualizar Utilizador';
        $auth->add($visualizarUtilizador);

        $editarUtilizador = $auth->createPermission('editarUtilizador');
        $editarUtilizador->description = 'Editar Utilizador';
        $auth->add($editarUtilizador);

        $eliminarUtilizador = $auth->createPermission('eliminarUtilizador');
        $eliminarUtilizador->description = 'Eliminar Utilizador';
        $auth->add($eliminarUtilizador);

        $bloquearUtilizador = $auth->createPermission('bloquearUtilizador');
        $bloquearUtilizador->description = 'Ativar / Bloquear Utilizador';
        $auth->add($bloquearUtilizador);

        // Permissões de Unidades de Saúde / Hospitais
        $criarHospital = $auth->createPermission('criarHospital');
        $criarHospital->description = 'Criar e Configurar Hospital / Clínica';
        $auth->add($criarHospital);

        $gerirRecursosHospital = $auth->createPermission('gerirRecursosHospital');
        $gerirRecursosHospital->description = 'Gerir Salas e Equipamentos do Hospital';
        $auth->add($gerirRecursosHospital);

        $gerirProfissionaisHospital = $auth->createPermission('gerirProfissionaisHospital');
        $gerirProfissionaisHospital->description = 'Gerir Profissionais Associados à Instituição';
        $auth->add($gerirProfissionaisHospital);

        // Permissões de Especialidades e Configuração
        $gerirEspecialidades = $auth->createPermission('gerirEspecialidades');
        $gerirEspecialidades->description = 'Gerir Especialidades';
        $auth->add($gerirEspecialidades);

        $gerirConfiguracaoSistema = $auth->createPermission('gerirConfiguracaoSistema');
        $gerirConfiguracaoSistema->description = 'Gerir Configurações Globais do Sistema';
        $auth->add($gerirConfiguracaoSistema);

        // Permissões de Agendas e Sessões
        $gerirAgendaEHorarios = $auth->createPermission('gerirAgendaEHorarios');
        $gerirAgendaEHorarios->description = 'Definir e Gerir Agenda / Horários';
        $auth->add($gerirAgendaEHorarios);

        $visualizarAgendamento = $auth->createPermission('visualizarAgendamento');
        $visualizarAgendamento->description = 'Visualizar Agendamentos e Sessões';
        $auth->add($visualizarAgendamento);

        $marcarAgendamento = $auth->createPermission('marcarAgendamento');
        $marcarAgendamento->description = 'Marcar Sessão / Consulta';
        $auth->add($marcarAgendamento);

        $cancelarAgendamento = $auth->createPermission('cancelarAgendamento');
        $cancelarAgendamento->description = 'Cancelar ou Remarcar Sessão';
        $auth->add($cancelarAgendamento);

        $visualizarMapaGlobalMarcações = $auth->createPermission('visualizarMapaGlobalMarcações');
        $visualizarMapaGlobalMarcações->description = 'Visualizar Mapa Global de Marcações';
        $auth->add($visualizarMapaGlobalMarcações);

        // Permissões Clínicas
        $registarNotaClinica = $auth->createPermission('registarNotaClinica');
        $registarNotaClinica->description = 'Registar Notas e Evolução Clínica';
        $auth->add($registarNotaClinica);

        $visualizarHistoricoClinico = $auth->createPermission('visualizarHistoricoClinico');
        $visualizarHistoricoClinico->description = 'Consultar Histórico Clínico do Paciente';
        $auth->add($visualizarHistoricoClinico);

        // Permissões de Relatórios e Indicadores
        $visualizarRelatoriosDesempenho = $auth->createPermission('visualizarRelatoriosDesempenho');
        $visualizarRelatoriosDesempenho->description = 'Consultar Indicadores e Relatórios de Desempenho';
        $auth->add($visualizarRelatoriosDesempenho);

        // Permissões de Perfil Pessoal
        $atualizarDadosPessoais = $auth->createPermission('atualizarDadosPessoais');
        $atualizarDadosPessoais->description = 'Atualizar Dados Pessoais do Próprio Perfil';
        $auth->add($atualizarDadosPessoais);


        // ==========================================
        // 2. CRIAR ROLES E ATRIBUIR PERMISSÕES
        // ==========================================

        // ------------------------------------------
        // Role: PACIENTE / UTENTE
        // ------------------------------------------
        $paciente = $auth->createRole('paciente');
        $paciente->description = 'Paciente / Utente';
        $auth->add($paciente);

        $auth->addChild($paciente, $visualizarAgendamento);
        $auth->addChild($paciente, $marcarAgendamento);
        $auth->addChild($paciente, $cancelarAgendamento);
        $auth->addChild($paciente, $visualizarHistoricoClinico);
        $auth->addChild($paciente, $atualizarDadosPessoais);

        // ------------------------------------------
        // Role: PROFISSIONAL DE SAÚDE / TERAPEUTA
        // ------------------------------------------
        $profissional = $auth->createRole('profissional');
        $profissional->description = 'Profissional de Saúde / Terapeuta';
        $auth->add($profissional);

        $auth->addChild($profissional, $gerirAgendaEHorarios);
        $auth->addChild($profissional, $visualizarAgendamento);
        $auth->addChild($profissional, $registarNotaClinica);
        $auth->addChild($profissional, $visualizarHistoricoClinico);
        $auth->addChild($profissional, $atualizarDadosPessoais);

        // ------------------------------------------
        // Role: REPRESENTANTE DO HOSPITAL / RESPONSÁVEL
        // ------------------------------------------
        $representanteHospital = $auth->createRole('representanteHospital');
        $representanteHospital->description = 'Responsável do Hospital / Representante';
        $auth->add($representanteHospital);

        $auth->addChild($representanteHospital, $gerirProfissionaisHospital);
        $auth->addChild($representanteHospital, $gerirRecursosHospital);
        $auth->addChild($representanteHospital, $visualizarMapaGlobalMarcações);
        $auth->addChild($representanteHospital, $visualizarRelatoriosDesempenho);
        $auth->addChild($representanteHospital, $atualizarDadosPessoais);

        // ------------------------------------------
        // Role: SYS ADMIN (ADMINISTRADOR DO SISTEMA)
        // ------------------------------------------
        $sysAdmin = $auth->createRole('sysAdmin');
        $sysAdmin->description = 'Administrador do Sistema';
        $auth->add($sysAdmin);

        // Permissões diretas do Sys Admin
        $auth->addChild($sysAdmin, $criarUtilizador);
        $auth->addChild($sysAdmin, $visualizarUtilizador);
        $auth->addChild($sysAdmin, $editarUtilizador);
        $auth->addChild($sysAdmin, $eliminarUtilizador);
        $auth->addChild($sysAdmin, $bloquearUtilizador);
        $auth->addChild($sysAdmin, $criarHospital);
        $auth->addChild($sysAdmin, $gerirEspecialidades);
        $auth->addChild($sysAdmin, $gerirConfiguracaoSistema);

        // Nota: Se o Sys Admin precisar de ter acesso a tudo o que os outros fazem,
        // podes também herdar os papéis:
        // $auth->addChild($sysAdmin, $representanteHospital);
        // $auth->addChild($sysAdmin, $profissional);

        echo "RBAC inicializado com sucesso!\n";
    }
}