<?php
//����΢����¼�ӿڲ�������

$apiOrder = 4; //�ӿ���ţ������޸�
$apiName = 'weibo'; //�ӿ����������޸�
$apiTitle = '����΢��'; //�ӿڱ��⣬�����޸�

$apiConfigs[$apiName] = array(); //��ʼ���������飬�����޸�

$apiConfigs[$apiName]['appid'] = '2494144665';  //Ӧ��ID������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['appkey'] = 'bbff7abde5968b783f2613a9189dbd9f';  //�ӿ���Կ������ʵ�������ֵ�޸�

$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //��¼�󷵻صı�վ��ַ�������޸�

$apiConfigs[$apiName]['scope'] = ''; //������Ȩ��Щapi�ӿڣ���Ӣ�Ķ��ŷָ�
?>