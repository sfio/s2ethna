    {form action=$script ethna_action="example_bbs_write_do" method="POST"}{uniqid}{*csrfid*}
      投稿者 {form_input name="name" size="21" maxlength="20"}<br>
      Ｅメール {form_input name="email" size="40"}<br>
      題名 {form_input name="subject" size="51" maxlength="50"}<br>
      内容 <font size="-1"><br>
      {form_input name="body" rows="5" cols="70" wrap="off"}<br>
      <p>
        {form_submit value="投稿"}{form_submit type="reset" value="キャンセル"}
      </p>
    {/form}
