<?php
//ips֧����ز���

$jieqiPayset['ips']['payid'] = '123456';  //�̻����

$jieqiPayset['ips']['paykey'] = '123456';  //��Կֵ

$jieqiPayset['ips']['payurl'] = 'http://pay.ips.com.cn/ipayment.aspx';  //�ύ��֧����վ����ַ

$jieqiPayset['ips']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/ipsreturn.php';  //��վ���շ��ص���ַ

$jieqiPayset['ips']['payrate'] = 100; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
$jieqiPayset['ips']['paycustom'] = 0; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['ips']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['ips']['moneytype'] = '0';  //�ֽ����ͣ�0-����� 1-��Ԫ
$jieqiPayset['ips']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���

$jieqiPayset['ips']['Currency_Type'] = 'RMB';  //���� RMB-�����

$jieqiPayset['ips']['Gateway_Type'] = '01'; //֧������ 01-����� 128-���ÿ� 04-IPS�ʻ� 16-�绰 32-�ֻ� 1024-�ֻ�����

$jieqiPayset['ips']['Lang'] = 'GB';  //GB ���� EN Ӣ��

$jieqiPayset['ips']['FailUrl'] = ''; //ʧ�ܷ���URL

$jieqiPayset['ips']['RetEncodeType'] = '17';  //������֤��ʽ 17-MD5

$jieqiPayset['ips']['OrderEncodeType'] = '5';  //�ύ��֤��ʽ 0-�޼���  5-MD5

$jieqiPayset['ips']['Rettype'] = '0';  //���ط�ʽ 0-browser 1��server to server

$jieqiPayset['ips']['Attach'] = '';  //�����ַ���

$jieqiPayset['ips']['addvars'] = array();  //���Ӳ���
?>