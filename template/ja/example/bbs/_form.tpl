    {form action=$script ethna_action="example_bbs_write_do" method="POST"}{uniqid}{*csrfid*}
      ��Ƽ� {form_input name="name" size="21" maxlength="20"}<br>
      �ť᡼�� {form_input name="email" size="40"}<br>
      ��̾ {form_input name="subject" size="51" maxlength="50"}<br>
      ���� <font size="-1"><br>
      {form_input name="body" rows="5" cols="70" wrap="off"}<br>
      <p>
        {form_submit value="���"}{form_submit type="reset" value="����󥻥�"}
      </p>
    {/form}
