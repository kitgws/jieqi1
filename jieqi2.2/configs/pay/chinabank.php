<?php
//����֧����ز���

$jieqiPayset['chinabank']['payid']='12345678';  //�̻����

$jieqiPayset['chinabank']['paykey']='xxxxxxxx';  //��Կֵ

$jieqiPayset['chinabank']['foreignpayid']='12345678';  //�⿨�̻����

$jieqiPayset['chinabank']['foreignpaykey']='xxxxxxxx';  //�⿨��Կֵ

$jieqiPayset['chinabank']['payurl']='https://pay3.chinabank.com.cn/PayGate';  //�ύ���Է�����ַ

$jieqiPayset['chinabank']['payreturn']='http://www.domain.com/modules/pay/chinabankreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['chinabank']['paycheck']='http://www.domain.com/modules/pay/chinabankcheck.php';  //��̨������ϢУ���ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['chinabank']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['chinabank']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['chinabank']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['chinabank']['style']='0';  //����ģʽ0(��ͨ�б�)��1(�����б��д��⿨)

$jieqiPayset['chinabank']['remark1']='0';  //��ע�ֶ�1

$jieqiPayset['chinabank']['remark2']='0';  //��ע�ֶ�2

$jieqiPayset['chinabank']['addvars']=array();  //���Ӳ���
?>