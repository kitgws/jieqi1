<?php
//sndagame֧����ز���(ʢ����Ϸ��)

$jieqiPayset['sndagame']['payid']='123456';  //�̻����

$jieqiPayset['sndagame']['paykey']='******';  //��Կֵ

$jieqiPayset['sndagame']['payurl']='http://pay.15173.com/Pay_gate.aspx';  //�ύ���Է�����ַ

$jieqiPayset['sndagame']['payreturn']='http://www6.2100book.com/modules/pay/15173return.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

$jieqiPayset['sndagame']['paynotify']='http://www6.2100book.com/modules/pay/15173notify.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)
/*
5Ԫ     380�����ͱ�
10Ԫ    780�����ͱ�
30Ԫ    2420�����ͱ�
45Ԫ    3660�����ͱ�
50Ԫ    4070�����ͱ�
100Ԫ   8150�����ͱ�
1000Ԫ  81800�����ͱ�*/
//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['sndagame']['paylimit']=array('380'=>'5', '780'=>'10', '2420'=>'30','3660'=>'45', '4070'=>'50', '8150'=>'100', '81800'=>'1000');
//֧�����ӻ���
$jieqiPayset['sndagame']['payscore']=array('380'=>'50', '780'=>'100', '2420'=>'300','3660'=>'450', '4070'=>'500', '8150'=>'1000', '81800'=>'10000');

$jieqiPayset['sndagame']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['sndagame']['paytype']='c';  //a �����п�֧�� b ����һ��֧ͨ�� c ʢ��֧�� d ��;��Ϸ��֧�� i ��Ѷ�绰֧�� n �Ѻ�һ��֧ͨ�� o 5173��ֵ��֧�� q ����һ��֧ͨ�� r ��ѶQ�ҿ�֧�� f ���п�����֧�� g �Ƹ�ͨ�ʻ�֧��

$jieqiPayset['sndagame']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['sndagame']['currency']='1';  //�������� 1Ϊ����� 3Ϊ�����п�

$jieqiPayset['sndagame']['pemail']='';  //������email

$jieqiPayset['sndagame']['merchant_param']='';  //�̻���Ҫ���ݵ���Ϣ�����ջ��˵�ַ

$jieqiPayset['sndagame']['isSupportDES']='2';  //�Ƿ�ȫУ��,1��У�� 2Ϊ��У��,�Ƽ�

$jieqiPayset['sndagame']['pid_sndagameaccount']='';  //����/��������̻����

$jieqiPayset['sndagame']['addvars']=array();  //���Ӳ���
?>