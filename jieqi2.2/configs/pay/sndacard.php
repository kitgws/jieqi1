<?php
//sndacard֧����ز���

$jieqiPayset['sndacard']['payid']='123456';  //�̻����

$jieqiPayset['sndacard']['paykey']='******';  //��Կֵ

$jieqiPayset['sndacard']['payurl']='http://61.172.247.108/PayNet/CardPay.aspx';  //�ύ���Է�����ַ
//http://61.172.247.108/PayNet/CardPay.aspx  ����
//http://pay.16288.com/CardPay.aspx ��ʽ

$jieqiPayset['sndacard']['payreturn']='http://www.domain.com/modules/pay/sndacardreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['sndacard']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['sndacard']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['sndacard']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����


$jieqiPayset['sndacard']['bizcode']='03';  //03����Ϸ�㿨 04������֧�� 01��ʢ��Esales֧��

$jieqiPayset['sndacard']['callbacktype']='01';  //���ص�ַ��ʽ 01��URL  02��Web Service  03��Socket

$jieqiPayset['sndacard']['ex1']='';  //��ע1

$jieqiPayset['sndacard']['ex2']='';  //��ע2

$jieqiPayset['sndacard']['signurl']='http://localhost:8080/shandasign.jsp';  //ǩ��url

$jieqiPayset['sndacard']['verifyurl']='http://localhost:8080/shandaverify.jsp';  //��֤url

$jieqiPayset['sndacard']['checkstr']='cwjsignwithshanda';  //ǩ��У��

$jieqiPayset['sndacard']['showurl']='http://www.domain.com/modules/pay/sndacardshow.php';  //��ʾ�����Ƿ�ɹ�����ָ

$jieqiPayset['sndacard']['addvars']=array();  //���Ӳ���
?>