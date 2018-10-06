import requests


class General:
    def __init__(self):
        """Create a session! """
        self.url = 'http://localhost/interview/'
        self.session = requests.session()
        pass

    def register(self, user, pwd):
        url = self.url + 'register/regcheck.php'
        data = dict()
        data['Submit'] = '注册'
        data['username'] = user
        data['password'] = pwd
        data['confirm'] = pwd
        r = requests.post(url, data=data)
        if r.text == "can't find '__main__' module":
            return 1
        else:
            return 0

    def login(self, user, pwd):
        url = self.url + 'register/logincheck.php'
        data = dict()
        data['submit'] = '登陆'
        data['username'] = user
        data['password'] = pwd
        r = self.session.post(url, data=data)
        return self

    def sign_in(self, id_):
        """签到"""
        pass

    def call_for(self, id_):
        """准备面试"""
        pass

    def arrange(self, id_):
        """已出发"""
        pass

    def write_cmt(self, who, text):
        pass

    def enroll_action(self, id_, page, action=1):
        url = format('%sparis-v2.0/%s.php' % (self.url, page))
        # url = 'http://httpbin.org/post'
        if action == 0:
            id_ = 0 - id_
        data_ = {'id': id_}
        r = self.session.post(url, data=data_)
        return self


if __name__ == '__main__':
    cur = General()
    users = ['net', 'tech', 'clinic', 'dm', 'org']
    pwds = ['net', 'tech', 'clinic', 'dm', 'org']
    # for i in range(5):
    #    cur.register(users[i], pwds[i])
    net = General().login(users[0], pwds[0])
    tech = General().login(users[1], pwds[1])
    clinic = General().login(users[2], pwds[2])
    dm = General().login(users[3], pwds[3])
    org = General().login(users[4], pwds[4])
    net.enroll_action(54, 'wait', 0)
    tech.enroll_action(54, 'wait', 0)
    clinic.enroll_action(54, 'wait', 0)
