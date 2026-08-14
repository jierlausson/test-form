# MyClinic360 — Teste de integração de leads

Harness manual para testar a integração de formulários de marketing com o endpoint de leads do backend MyClinic360.

## O que este projeto faz

- disponibiliza uma página HTML de teste em `public/index.html`;
- coleta dados de um lead e envia o payload para o proxy PHP;
- encaminha a requisição para o endpoint externo de leads;
- exibe na tela o status e a resposta da integração.

Este diretório não é a aplicação Flutter de formulários clínicos. Para esse produto, consulte o repositório `forms_myclinic360`.

## Estrutura

```text
public/index.html   Interface do teste
public/proxy.php    Proxy HTTP para o backend
public/robots.txt   Regras de indexação
form-test.html      Variante estática do formulário
```

## Execução local

Requer PHP com suporte a cURL:

```bash
cd form-test/public
php -S 127.0.0.1:8080
```

Acesse `http://127.0.0.1:8080` no navegador.

## Configuração

Antes de usar o proxy em qualquer ambiente, valide:

- URL do endpoint de leads;
- chave de integração enviada ao backend;
- certificado TLS e timeout;
- origem permitida e regras de CORS;
- logs e política de retenção dos dados enviados.

Credenciais e chaves de integração devem ser injetadas por configuração segura do servidor, nunca versionadas no HTML, no PHP ou neste README.

## Uso recomendado

Este projeto deve ser tratado como ferramenta de teste/diagnóstico. Para produção, use o fluxo oficial de formulário e o endpoint protegido do backend, com gestão de segredo no servidor e validação de payload adequada.

## Relação com o ecossistema

```text
form-test → endpoint de leads do backend Laravel
forms_myclinic360 → questionários clínicos via API Laravel
my_clinic_360 → aplicação principal do profissional
```
