<?php
//sndaesale֧����ز���

$jieqiPayset['sndaesale']['payid']='123456';  //�̻����

$jieqiPayset['sndaesale']['paykey']='******';  //��Կֵ

$jieqiPayset['sndaesale']['payurl']='http://61.172.247.108/PayNet/EsalesPay.aspx';  //�ύ���Է�����ַ
//http://61.172.247.108/PayNet/EsalesPay.aspx  ����
//http://pay.16288.com/EsalesPay.aspx ��ʽ

$jieqiPayset['sndaesale']['payreturn']='http://www.domain.com/modules/pay/sndaesalereturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['sndaesale']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['sndaesale']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['sndaesale']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����


$jieqiPayset['sndaesale']['bizcode']='01';  //03����Ϸ�㿨 04������֧�� 01��ʢ��Esales֧��

$jieqiPayset['sndaesale']['callbacktype']='01';  //���ص�ַ��ʽ 01��URL  02��Web Service  03��Socket

$jieqiPayset['sndaesale']['ex1']='';  //��ע1

$jieqiPayset['sndaesale']['ex2']='';  //��ע2

$jieqiPayset['sndaesale']['signurl']='http://localhost:8080/shandasign.jsp';  //ǩ��url

$jieqiPayset['sndaesale']['verifyurl']='http://localhost:8080/shandaverify.jsp';  //��֤url

$jieqiPayset['sndaesale']['checkstr']='cwjsignwithshanda';  //ǩ��У��

$jieqiPayset['sndacard']['showurl']='http://www.domain.com/modules/pay/sndaesaleshow.php';  //��ʾ�����Ƿ�ɹ�����ָ

$jieqiPayset['sndaesale']['addvars']=array();  //���Ӳ���
?>