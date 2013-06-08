<?
class View extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("template");
        $this->load->model("MenuModel");
    }

    public function index()
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        $first_key = key($slideBarList); // First Element's Key
        $slideBarList[$first_key]['Active'] = "active";
        $content = "BookView";
        $data = array();

        $data["book"] = "��Ǫ̪��Ʋz�Ь�ѡG2500�i�B�J�ϸѡA�s�⥲�ƥv�W��²��I�ݳo���A�O�Ҥ����ѡI";
        $data["ISBN"] = "9789570410976";
        $data["category"] = "�ӷ~�z�]";
        $data["author"] = "�t�W��N";
        $data["translator"] = "";
        $data["publisher"] = "�j��";
        $data["date"] = "2012�~12��05��";
        $data["language"] = "�c�餤��";
        $data["price"] = "480";
        $data["description"] =
            "<P align=center><STRONG><FONT color=#ff0000>�饻���P�A�s�⥲�ơI�ݳo���A�O�Ҥ����ѡI&nbsp;&nbsp; </FONT></STRONG></P><P>�@�@���٦סB�v���B�j�[�B���ԡB���G�K�ӵۭ��жR���F�Ҧ����ơA����K�ӫ��}�l�O�H</P><P>�@�@�����u�@�f�j�p�v�쩳�O�h�p�H�Q�u�ֳ\�v�B�}�u�@���v�t�b���H�A���D�~�̤d�U����ΤO�b�H������ը��ƭn�q����O�J�H�p���q�ϥΤӤj����l�A�i��O���Ѫ���]�H���N���B���N�ަסB�ˤl�d�B�馡�����K���S���O�Ҧn�Y������ը���ҡH</P><P>�@�@�p�G�z�ߤ��]���o�˪��ðݡA����A�o�@���饻���P�B�s��Ū�̸s�w�諸�u��Ǫ̪��Ʋz�Ь�ѡv�]�A�F�馡�B�覡�B�����Ʋz�A������z�q�����ǳơB�ϥιD��B�s�@�L�{�B�Ʋz�K��x���ը��A�@�L�x�b���ɨ��U�p�i�ժ��ֽ�P���N�P�I</P><P>�@�@�W�L2500�i�ԺɹϸѡA�x���ը���{���A�s��]��ݥX�����I</P><P>�@�@�u��Ǫ̪��Ʋz�Ь�ѡv�W�L2500�i�ԺɹϸѡA����4�ӳ椸�A��1�� �Ʋz�򥻤��_�G���ǬO�K�Q���D��B���㪺�O�i��k�B���q�u�㪺�ϥΤ�k�B�������O�s�K��Ǫ̤]����@���A�M�A���P�}�l�I��2�� �Ʋz���򥻡G�Ǳ¦U�س̰򥻪��Ʋz�k---�]�A�G�L�N�B���f�^�K�k�B�o���B���N�B���N�B�]�N�B�ίN�B�����B�D�աK���A�ԲӪ��ϸѻP�����A�Ĥ@���i�p�Ф]��s���ѡI</P><P>�@�@�ը��ƪ���ҬO�M�w���D������I��3�� �ը����򥻡G�ԲӦC�X---�M���B�覡�B����U�ؽը�����{���B�ը��L����ҡB�馡�����P�ը��Ƥ�ҡB�ǰ_�ӷ|�ܤ�K����ġB�����P�������򥻡B��������{���B�ڦ��������@�k�B�F�Ѥ馡�ը��ƪ��ĪG�K���A���U�z���P�x�����D������I</P><P>�@�@�q�����ǳơB�Ʋz��ը��A�ѨM�C�D�檺�u�������g�I�v </P><P>�@�@���ѬO�~����j�a�R�Ϊ��u�|�I�Ь�ѡv�B�u���I�Ь�ѡv����A�̷s�Z�P�O�@�C�b�饻�j���n���AŪ�̶}�ߪ��^�T������աI�u��Ǫ̪��Ʋz�Ь�ѡv��ť�F�߷R�U�pŪ�̭̪��N���A�ܽШ쪾�W���t�W��N�Ѯv�˦۶Ǳ¡A100%����Ǫ��s��̶q�����y�I</P><P>�@�@�b��4�� ���������ƨ�G�����F����B�סB�������k�P�ƫe�B�z�k�C�o���B���N�B���N�B�]�N�K���U�ؤ��P���Ʋz�k�A��S�O�C�X�Ʋz��ϯ��G�ѨM�C�D�檺�u�������g�I�v�C�A���W���i�������ղz�λy���G�����B���h�w��B��O�N�ġB���⦸�B�N�աB�|�Q�B�����K�A�ѳo�ǥλy�A�N��Ʋz�Ҧ����СI</P><P>�@�@�U�ӳ��`�]�U���C��N��ϧO�A�]�����Ȧp�P���e�t�C���y�@�˪��ˤ��A��O�@�����ǩ������Ь�ѡC�w��Ҧ���U�p�����쪺�B�ͤ@�_�ոլݡA����@�w�|�ܦ��@��ּ֪��Ʊ��I</P><P><STRONG>�@�@��1�� �Ʋz�򥻤��_�G</STRONG>�ƻ��u��B�K�Q���D��B���㪺�O�i��k�B���q�u�㪺�ϥΤ�k�B�A�ѽվ㪺��k�B�������O�s�K��Ǫ̤]����@���A�M�A���P�}�l�I</P><P><STRONG>�@�@��2�� �Ʋz���򥻡G</STRONG>�Ǳ¦U�س̰򥻪��Ʋz�k---�]�A�G�L�N�B���f�^�K�k�B�o���B���N�B���N�B�]�N�B�ίN�B�����B�D�աK���A�ԲӪ��ϸѻP�����A�Ĥ@���i�p�Ф]��s���ѡI</P><P><STRONG>�@�@��3�� �ը����򥻡G</STRONG>�ԲӦC�X---�M���B�覡�B����U�ؽը�����{���B�ը��L����ҡB�馡�����P�ը��Ƥ�ҡB�ǰ_�ӷ|�ܤ�K����ġB�����P�������򥻡B��������{���B�ڦ��������@�k�B�F�Ѥ馡�ը��ƪ��ĪG�K���A���U�z���P�x�����D������I</P><P>�@�@�Ʋz��ϯ��G�ѨM�C�D�檺�u�������g�I�v</P><P>�@�@���i�������ղz�λy���G�����B���h�w��B��O�N�ġB���⦸�B�N�աB�|�Q�B�����K�A�ѥλy�N��Ʋz�Ҧ����СI</P><P><STRONG>�@�@��4�� ���������ƨ�G</STRONG>����B�סB�������ʡB���k�B�P�ƫe�B�z</P><P><STRONG>�@��²��</STRONG></P><P><STRONG>�t�W��N&nbsp; FUMIYO KAWAKAMI</STRONG></P><P>�@�@�j�����������ղz�v�M���Ǯղ��~�H��A�����Ӯ�¾��12�~�C</P><P>�@�@�P�O�󡼽ղz�v�M���Ǯժ��j�����աB�k�꨽�� (�kLyon) ���աBTSUJI GROUP SCHOOL��ߤ��ժ��M�~�Ʋz�H�����Ӥ�¾�ȡC</P><P>�@�@�����k�꨽�����ժ��Ĥ@��k���v�A�ô��b�k��3�P�\�UGeorges Blanc�ѻP�L��סC</P><P>�@�@��1996�~�_�A�o����DELICE DE CUILLERES�t�W��N�Ʋz�ЫǪ��t�d�H�C</P><P>�@�@������ղz�v�M���Ǯժ��~�u���v�C</P><P>�@�@�b�饻�U�a���t���|�B���x�B���ȵ��A���D�`�a���D�C</P><P>�@�@�ۦ��y�|�I�Ь�ѡz�B�y���I�Ь�ѡz�Ρy�q�j�Q��Ь�ѡz(�j�Ҥ�ƥX��)�C</P><P>�@�@�������ѥءG�k���űa�|�I����--20�د���41�D�|�I�ܤơB��¦�|�I�j��---80�عs�����I��200�زM�������ޥ��ϸѡB�W���ѥ]�b�a���G�ѵM�å��B�L�H�u�K�[���B100�H���d�B����+�������J�|77�ءG���d���ơ��C�}�t�衸�ٿ����������ܻ��J�|���㪩</P>";

        $this->template->loadView("Category", $slideBarList, $content, $data);
    }

    public function Category($categoryID)
    {
        $slideBarList = $this->MenuModel->getCategoryList();
        //$slideBarList[0]['Active'] = "active";
        $slideBarList[$categoryID]['Active'] = "active";

        $content = "CategoryView";
        $data = array();
        $data["book"] = "��Ǫ̪��Ʋz�Ь�ѡG2500�i�B�J�ϸѡA�s�⥲�ƥv�W��²��I�ݳo���A�O�Ҥ����ѡI";
        $data["ISBN"] = "9789570410976";
        $data["category"] = "�ӷ~�z�]";
        $data["author"] = "�t�W��N";
        $data["translator"] = "";
        $data["publisher"] = "�j��";
        $data["date"] = "2012�~12��05��";
        $data["language"] = "�c�餤��";
        $data["price"] = "480";
        $data["description"] =
            "<P align=center><STRONG><FONT color=#ff0000>�饻���P�A�s�⥲�ơI�ݳo���A�O�Ҥ����ѡI&nbsp;&nbsp; </FONT></STRONG></P><P>�@�@���٦סB�v���B�j�[�B���ԡB���G�K�ӵۭ��жR���F�Ҧ����ơA����K�ӫ��}�l�O�H</P><P>�@�@�����u�@�f�j�p�v�쩳�O�h�p�H�Q�u�ֳ\�v�B�}�u�@���v�t�b���H�A���D�~�̤d�U����ΤO�b�H������ը��ƭn�q����O�J�H�p���q�ϥΤӤj����l�A�i��O���Ѫ���]�H���N���B���N�ަסB�ˤl�d�B�馡�����K���S���O�Ҧn�Y������ը���ҡH</P><P>�@�@�p�G�z�ߤ��]���o�˪��ðݡA����A�o�@���饻���P�B�s��Ū�̸s�w�諸�u��Ǫ̪��Ʋz�Ь�ѡv�]�A�F�馡�B�覡�B�����Ʋz�A������z�q�����ǳơB�ϥιD��B�s�@�L�{�B�Ʋz�K��x���ը��A�@�L�x�b���ɨ��U�p�i�ժ��ֽ�P���N�P�I</P><P>�@�@�W�L2500�i�ԺɹϸѡA�x���ը���{���A�s��]��ݥX�����I</P><P>�@�@�u��Ǫ̪��Ʋz�Ь�ѡv�W�L2500�i�ԺɹϸѡA����4�ӳ椸�A��1�� �Ʋz�򥻤��_�G���ǬO�K�Q���D��B���㪺�O�i��k�B���q�u�㪺�ϥΤ�k�B�������O�s�K��Ǫ̤]����@���A�M�A���P�}�l�I��2�� �Ʋz���򥻡G�Ǳ¦U�س̰򥻪��Ʋz�k---�]�A�G�L�N�B���f�^�K�k�B�o���B���N�B���N�B�]�N�B�ίN�B�����B�D�աK���A�ԲӪ��ϸѻP�����A�Ĥ@���i�p�Ф]��s���ѡI</P><P>�@�@�ը��ƪ���ҬO�M�w���D������I��3�� �ը����򥻡G�ԲӦC�X---�M���B�覡�B����U�ؽը�����{���B�ը��L����ҡB�馡�����P�ը��Ƥ�ҡB�ǰ_�ӷ|�ܤ�K����ġB�����P�������򥻡B��������{���B�ڦ��������@�k�B�F�Ѥ馡�ը��ƪ��ĪG�K���A���U�z���P�x�����D������I</P><P>�@�@�q�����ǳơB�Ʋz��ը��A�ѨM�C�D�檺�u�������g�I�v </P><P>�@�@���ѬO�~����j�a�R�Ϊ��u�|�I�Ь�ѡv�B�u���I�Ь�ѡv����A�̷s�Z�P�O�@�C�b�饻�j���n���AŪ�̶}�ߪ��^�T������աI�u��Ǫ̪��Ʋz�Ь�ѡv��ť�F�߷R�U�pŪ�̭̪��N���A�ܽШ쪾�W���t�W��N�Ѯv�˦۶Ǳ¡A100%����Ǫ��s��̶q�����y�I</P><P>�@�@�b��4�� ���������ƨ�G�����F����B�סB�������k�P�ƫe�B�z�k�C�o���B���N�B���N�B�]�N�K���U�ؤ��P���Ʋz�k�A��S�O�C�X�Ʋz��ϯ��G�ѨM�C�D�檺�u�������g�I�v�C�A���W���i�������ղz�λy���G�����B���h�w��B��O�N�ġB���⦸�B�N�աB�|�Q�B�����K�A�ѳo�ǥλy�A�N��Ʋz�Ҧ����СI</P><P>�@�@�U�ӳ��`�]�U���C��N��ϧO�A�]�����Ȧp�P���e�t�C���y�@�˪��ˤ��A��O�@�����ǩ������Ь�ѡC�w��Ҧ���U�p�����쪺�B�ͤ@�_�ոլݡA����@�w�|�ܦ��@��ּ֪��Ʊ��I</P><P><STRONG>�@�@��1�� �Ʋz�򥻤��_�G</STRONG>�ƻ��u��B�K�Q���D��B���㪺�O�i��k�B���q�u�㪺�ϥΤ�k�B�A�ѽվ㪺��k�B�������O�s�K��Ǫ̤]����@���A�M�A���P�}�l�I</P><P><STRONG>�@�@��2�� �Ʋz���򥻡G</STRONG>�Ǳ¦U�س̰򥻪��Ʋz�k---�]�A�G�L�N�B���f�^�K�k�B�o���B���N�B���N�B�]�N�B�ίN�B�����B�D�աK���A�ԲӪ��ϸѻP�����A�Ĥ@���i�p�Ф]��s���ѡI</P><P><STRONG>�@�@��3�� �ը����򥻡G</STRONG>�ԲӦC�X---�M���B�覡�B����U�ؽը�����{���B�ը��L����ҡB�馡�����P�ը��Ƥ�ҡB�ǰ_�ӷ|�ܤ�K����ġB�����P�������򥻡B��������{���B�ڦ��������@�k�B�F�Ѥ馡�ը��ƪ��ĪG�K���A���U�z���P�x�����D������I</P><P>�@�@�Ʋz��ϯ��G�ѨM�C�D�檺�u�������g�I�v</P><P>�@�@���i�������ղz�λy���G�����B���h�w��B��O�N�ġB���⦸�B�N�աB�|�Q�B�����K�A�ѥλy�N��Ʋz�Ҧ����СI</P><P><STRONG>�@�@��4�� ���������ƨ�G</STRONG>����B�סB�������ʡB���k�B�P�ƫe�B�z</P><P><STRONG>�@��²��</STRONG></P><P><STRONG>�t�W��N&nbsp; FUMIYO KAWAKAMI</STRONG></P><P>�@�@�j�����������ղz�v�M���Ǯղ��~�H��A�����Ӯ�¾��12�~�C</P><P>�@�@�P�O�󡼽ղz�v�M���Ǯժ��j�����աB�k�꨽�� (�kLyon) ���աBTSUJI GROUP SCHOOL��ߤ��ժ��M�~�Ʋz�H�����Ӥ�¾�ȡC</P><P>�@�@�����k�꨽�����ժ��Ĥ@��k���v�A�ô��b�k��3�P�\�UGeorges Blanc�ѻP�L��סC</P><P>�@�@��1996�~�_�A�o����DELICE DE CUILLERES�t�W��N�Ʋz�ЫǪ��t�d�H�C</P><P>�@�@������ղz�v�M���Ǯժ��~�u���v�C</P><P>�@�@�b�饻�U�a���t���|�B���x�B���ȵ��A���D�`�a���D�C</P><P>�@�@�ۦ��y�|�I�Ь�ѡz�B�y���I�Ь�ѡz�Ρy�q�j�Q��Ь�ѡz(�j�Ҥ�ƥX��)�C</P><P>�@�@�������ѥءG�k���űa�|�I����--20�د���41�D�|�I�ܤơB��¦�|�I�j��---80�عs�����I��200�زM�������ޥ��ϸѡB�W���ѥ]�b�a���G�ѵM�å��B�L�H�u�K�[���B100�H���d�B����+�������J�|77�ءG���d���ơ��C�}�t�衸�ٿ����������ܻ��J�|���㪩</P>";

        $this->template->loadView("Category", $slideBarList, $content, $data);
    }
}

?>