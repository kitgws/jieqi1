<?php
//vnetone.com��Ѷ֧����ز��� ��ӯһ��ͨ

$jieqiPayset['vnetone']['payid']='123456';  //�̻����

$jieqiPayset['vnetone']['paykey']='******';  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

$jieqiPayset['vnetone']['payurl']='http://s2.vnetone.com/Default.aspx';  //�ύ���Է�����ַ

$jieqiPayset['vnetone']['payreturn']='http://www.yingxj.com/jie/jieqicms/modules/pay/vnetonereturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['vnetone']['paylimit']=array('200'=>'2', '500'=>'5', '1000'=>'10', '1500'=>'15', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');
//֧�����ӻ���
//$jieqiPayset['vnetone']['payscore']=array('200'=>'20', '500'=>'50', '1000'=>'100', '1500'=>'150', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['vnetone']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['vnetone']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����


$jieqiPayset['vnetone']['errreturn']='http://www.yingxj.com/jie/jieqicms/modules/pay/vnetonereturn.php';  //���մ��󷵻صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['vnetone']['version']='vpay1001';  //ӯ��Ѷ���ӿڰ汾 ���ڰ汾��vpay1001

$jieqiPayset['vnetone']['agentself']='';  //�û��Լ�����16���ַ����� ����Ϊ��


$jieqiPayset['vnetone']['addvars']=array();  //���Ӳ���
?>