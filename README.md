# checkout-cielo
## Uso do Checkout Cielo com cURL em PHP

### Créditos:
* Dimas A. Pante (https://github.com/dimaspante/checkout-cielo)

### Detalhes:

* Links de retorno, notificação de compra e mudança de status devem ser definidos no painel financeiro da Cielo, não mais no json enviado;
* O ID da transação retornado é o TID (o NSU da bandeira não é mais retornado);
* Caso esteja sendo usado o certificado de segurança da hospedagem (ex. Let's Encrypt), utilizar "*CURLOPT_SSL_VERIFYPEER*" no cURL;
* *Soft descriptor* não pode possuir espaços, acentos, underlines ou hífens.

---

### Arquivos:

* send.php = Gera os dados e direciona o usuário para o Checkout Cielo;
* notifica.php = URL chamada pela Cielo ao ser finalizado um pedido no Checkout;
* muda.php = URL chamada pela Cielo ao haver novo status do pedido (aprovado, cancelado, pendente, etc).

---

### Mais informações:

https://developercielo.github.io/manual/checkout-cielo
