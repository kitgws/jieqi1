<?php
//֧������ֵ��ز���

$jieqiPayset['alipay']['payid'] = '2088121633642457';  //�������ID��������ʵ�������ֵ��

$jieqiPayset['alipay']['paykey'] = 'p7fffdl7czi7jkgfr1wl4tb6jxvjm4pv';  //ͨѶ��Կֵ��������ʵ�������ֵ��

$jieqiPayset['alipay']['payurl'] = 'https://mapi.alipay.com/gateway.do';  //�ύ��֧����վ����ַ

$jieqiPayset['alipay']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/alipayreturn.php';  //��վ���շ��ص���ַ

$jieqiPayset['alipay']['payrate'] = 100; //Ĭ�ϳ�ֵ1ԪǮ�һ�����ҵ�ֵ
$jieqiPayset['alipay']['paycustom'] = 0; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['alipay']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['alipay']['moneytype'] = '0';  //������ͣ�0-����� 1-��Ԫ
$jieqiPayset['alipay']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���
$jieqiPayset['alipay']['service'] = 'create_direct_pay_by_user';  //��������
$jieqiPayset['alipay']['agent'] = '';  //������id
$jieqiPayset['alipay']['_input_charset'] = 'GBK';  //�ַ���
$jieqiPayset['alipay']['subject'] = JIEQI_EGOLD_NAME;  //��Ʒ����
$jieqiPayset['alipay']['payment_type'] = '1';  // ��Ʒ֧������ 1����Ʒ���� 2�������� 3���������� 4������ 5���ʷѲ��� 6������
$jieqiPayset['alipay']['show_url'] = JIEQI_LOCAL_URL;  //��Ʒ�����վ��˾
$jieqiPayset['alipay']['seller_email'] = '15156188688@163.com';  //�������䣬������д
$jieqiPayset['alipay']['sign_type'] = 'MD5';  //ǩ����ʽ

$jieqiPayset['alipay']['notify_url'] = JIEQI_LOCAL_URL.'/modules/pay/alipayreturn.php'; //��վ�����첽���ص���ַ
$jieqiPayset['alipay']['notifycheck'] = 'http://notify.alipay.com/trade/notify_query.do';  //֧����֪ͨ��֤��ַ

$jieqiPayset['alipay']['addvars'] = array();  //���Ӳ���
?>












