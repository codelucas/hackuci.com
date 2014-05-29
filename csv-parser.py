#!/usr/bin/python2.7
"""
Custom HackUCI script that rips open an eventbrite CSV file
and extracts out the number of students attending based on
features of targeted students.
"""
import os

dirname = os.path.dirname(os.path.realpath(__file__))
filename = 'LATEST.csv'
csv_path = os.path.join(dirname, filename)


def get_email(csv_line):
    """
    Extracts out an all lowercase email string from
    a CSV line delimited by commas.
    """
    chunks = csv_line.split(',')
    email = chunks[2]
    email = email.lower()
    return email


def get_school(csv_line):
    """
    Extracts out an all lowercase school string from
    a CSV line delimited by commas.
    """
    chunks = csv_line.split(',')
    school = chunks[-1]
    school = school.lower()
    return school


def is_uci_student(csv_line):
    """
    Inspects a CSV line and returns True if the
    student attends UCI, else False
    """
    school = get_school(csv_line)
    pass_one = ('uci' in school)
    pass_two = ('irvine' in school and 'valley' not in school)
    pass_three = ('ics' in school)
    pass_four = ('bren' in school)
    return (pass_one or pass_two or pass_three or pass_four)


def is_highschool_or_cc_student(csv_Line):
    """
    Inspects a CSV line and returns True if the
    student attends a highschool or a community college,
    otherwise it returns False
    """
    school = get_school(csv_Line)
    pass_one = ('high' in school)
    pass_two = ('comm' in school or 'cc' in school)
    pass_three = ('ivc' in school)
    pass_four = ('college' in school)
    return (pass_one or pass_two or pass_three or pass_four)


def is_socal_student(csv_Line):
    """
    Inspects a CSV line and returns True if the
    student attends any university/CC/HS in Southern
    California, else False
    """
    pass


def main():
    with open(csv_path, 'r+') as f:
        data = f.read()
        raw_lines = data.split('\r\n')
        lines = [line.strip() for line in raw_lines if line]
        failed = []

        count = 0

        with open('/Users/lucas/Desktop/uci_emails.txt', 'w') as f:
            for line in lines:
                if is_uci_student(line):
                    print 'SUCCEED:', get_email(line), get_school(line), line
                    f.write(get_email(line) + '\r\n')
                    count += 1

                else:
                    failed.append(line)

        """
        buckets = {f:1 for f in failed}
        for f in failed:
            if f in buckets:
                buckets[f] += 1
            else :
                buckets[f] = 1

        list_buckets = [(k, v) for k, v in buckets.items()]
        ordered_buckets = sorted(list_buckets, key=lambda x: x[0])

        # failed = sorted(failed, key=lambda x: x)

        for e in ordered_buckets:
            print 'FAILED:', e[0], e[1]
        """

        print 'We have', count, \
            'total people registered from uci on eventbrite'

main()
