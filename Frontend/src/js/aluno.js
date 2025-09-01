// aluno.js
// Adicione aqui funcionalidades JS específicas para a página de cadastro de aluno.

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('formAluno');
  if (!form) return;
  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    const dados = {};
    form.querySelectorAll('input, select').forEach(input => {
      if (input.name) dados[input.name] = input.value;
    });
    try {
      const resp = await fetch('../api/cadastrar_aluno.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(dados)
      });
      const data = await resp.json();
      if (resp.ok && data.sucesso) {
        alert('Aluno cadastrado com sucesso!');
        form.reset();
      } else {
        alert(data.erro || 'Erro ao cadastrar aluno.');
      }
    } catch (err) {
      alert('Erro ao conectar ao servidor.');
    }
  });
});
