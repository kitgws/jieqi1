<?php
//��Ǯ��ֵ��֧����ز���

$jieqiPayset['99card']['payid'] = '123456';  //�̻����

$jieqiPayset['99card']['paykey'] = '000000';  //��Կֵ

$jieqiPayset['99card']['payurl'] = 'https://www.99bill.com/szxgateway/recvMerchantInfoAction.htm';  //�ύ���Է�����ַ

$jieqiPayset['99card']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/99cardreturn.php';  //��վ���շ��ص���ַ

$jieqiPayset['99card']['payrate'] = 100; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
$jieqiPayset['99card']['paycustom'] = 0; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['99card']['paylimit'] = array('1000'=>'10', '1500'=>'15', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100', '30000'=>'300', '50000'=>'500'); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['99card']['moneytype'] = '0';  //�ֽ����ͣ�0-����� 1-��Ԫ
$jieqiPayset['99card']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���
$jieqiPayset['99card']['inputCharset'] = '2'; //�ַ���,��Ϊ�ա�1����UTF-8; 2����GBK; 3����gb2312 Ĭ��ֵΪ1

$jieqiPayset['99card']['version'] = 'v2.0';  //������汾�Ź̶�Ϊv2.0

$jieqiPayset['99card']['language'] = '1';  //1�������ģ�2����Ӣ�� Ĭ��ֵΪ1

$jieqiPayset['99card']['signType'] = '1'; //1����MD5ǩ�� ��ǰ�汾�̶�Ϊ1

$jieqiPayset['99card']['payType'] = '42';  //41-��Ǯ�˻� 42-Ĭ�ϣ����ܺͿ�Ǯ�˻� 51-����֧��

$jieqiPayset['99card']['fullAmountFlag'] = '0';  //0�������С�ڶ������ʱ����֧�����Ϊʧ�ܣ�1�������С�ڶ�������Ƿ���֧�����Ϊ�ɹ���ͬʱ��������ʵ��֧����Ϊ�����п������.����̻����������п���ֱ��ʱ���������̶�ֵΪ1

$jieqiPayset['99card']['ext1'] = '';  //��չ�ֶ�1

$jieqiPayset['99card']['ext2'] = '';  //��չ�ֶ�2

$jieqiPayset['99card']['bossType'] = '9';  //������: 0-������ 1-��ͨ 3-���� 4-����һ��ͨ 9-���⿨����

$jieqiPayset['99card']['addvars'] = array();  //���Ӳ���
?>