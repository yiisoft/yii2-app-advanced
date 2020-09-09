###
# Modifying Yii2's files for initialize Vagrant VM
#
# @author HA3IK <golubha3ik@gmail.com>
# @version 1.0.0

BEGIN {
    print "AWK BEGINs its work:"
    IGNORECASE = 1
    # Correct IP - wildcard last octet
    match(ip, /(([0-9]+\.)+)/, arr)
    ip = arr[1] "*"
}
BEGINFILE {
    msg = "- Work with: " FILENAME
    # Define array index for the file
    switch (FILENAME) {
    case /environments\/dev\/(back|front)end\/config\/main\-local\.php$/:
        isFile["IsMainLocConf"] = 1
        msg = msg " - allow VM IP for Gii and debug toolbar"
        break
    }
    # Print the final message
    print msg
}
# BODY
{
    # IF environments/dev/(back|front)end/config/main-local.php
    if (isFile["IsMainLocConf"]) {
        # IF the line[s] after yii\(debug|gii)\Module
        if (FNR == nextLine["nubmer"]) {
            # Prepare for next line
            ++nextLine["nubmer"]
            # IF line has "allowedIPs"
            if (index($0, "allowedIPs")) {
                # IF our IP is not there
                if (!index($0, ip)) {
                    # Add it
                    match($0, /([^\]]+)(.+)/, arr)
                    $0 = sprintf("%s, '%s'%s", arr[1], ip, arr[2])
                }
                # Delete next line
                delete nextLine
            # IF "allowedIPs" are not set - search for the end of an array structure
            } else if ($0 ~ /\];$/) {
                # Rewrite line
                $0 = nextLine["indent"] "'allowedIPs' => ['127.0.0.1', '::1', '" ip "'],\n" $0
                delete nextLine
            }
            # IF line is done
            if (!length(nextLine)) {
                printf "  Line %d: Allowed IP: %s\n", FNR, ip
            }
        # Search for yii\(debug|gii)\Module
        } else if (match($0, /^(\s+).+yii\\(debug|gii)\\Module/, arr)) {
            # Save next line and indent
            nextLine["nubmer"] = FNR + 1
            nextLine["indent"] = arr[1]
        }
        # Rewrite the file
        print $0 > FILENAME
    }
}
ENDFILE {
    delete isFile
    close(FILENAME)
}
END {
    print "AWK ENDs its work."
}
