<?php
//tenpay֧����ز���

$jieqiPayset['tenpay']['payid']='123456';  //�̻����

$jieqiPayset['tenpay']['paykey']='******';  //��Կֵ

$jieqiPayset['tenpay']['payurl']='https://www.tenpay.com/cgi-bin/v1.0/pay_gate.cgi';  //�ύ���Է�����ַ

$jieqiPayset['tenpay']['payreturn']='http://www.domain.com/modules/pay/tenpayreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['tenpay']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');
//֧�����ӻ���
//$jieqiPayset['tenpay']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['tenpay']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['tenpay']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['tenpay']['payresult']='http://www.domain.com/modules/pay/tenpayresult.php?payid=%s&egold=%s&buyid=%s&buyname=%s';  //��ʾ֧������ĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['tenpay']['cmdno']='1';  //ҵ�����, �Ƹ�֧ͨ��֧���ӿ���  1

$jieqiPayset['tenpay']['bank_type']='0';  //��������:�Ƹ�֧ͨ����0

$jieqiPayset['tenpay']['fee_type']='1';  //�ֽ�֧�����֣�Ŀǰֻ֧������ң�1 - RMB�����, 2 - USD��Ԫ, 3 - HKD�۱�

$jieqiPayset['tenpay']['attach']='';  //�̼����ݰ���ԭ������

$jieqiPayset['tenpay']['addvars']=array();  //���Ӳ���
?>