<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de OpenLDAP
    $ldap_server = "127.0.0.1";
    $ldap_port = 389;
    $ldap_dn = "cn=admin,dc=near,dc=com";
    $ldap_password = "698.75k5241A*";
    $ldap_base_dn = "dc=near,dc=com";


    // Datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Conexión a OpenLDAP
    $ldap_conn = ldap_connect($ldap_server, $ldap_port) or die("No se pudo conectar a LDAP.");

    // Autenticación con OpenLDAP
    if ($ldap_conn) {
        ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

        $ldap_bind = ldap_bind($ldap_conn, $ldap_dn, $ldap_password);

        if ($ldap_bind) {
            // Búsqueda del usuario en el directorio LDAP
            $result = ldap_search($ldap_conn, $ldap_base_dn, "(uid=$username)");
            $entries = ldap_get_entries($ldap_conn, $result);

            if ($entries["count"] > 0) {
                // Intento de autenticación con el usuario encontrado
                $user_dn = $entries[0]["dn"];
                $bind = @ldap_bind($ldap_conn, $user_dn, $password);

                if ($bind) {
                    // Autenticación exitosa
                    $_SESSION["username"] = $username;
                    echo "Autenticación exitosa. Redirigiendo a la página principal...";
                    header("Location: principal.php");
                } else {
                    // Autenticación fallida
                    echo "Autenticación fallida. Verifica tu nombre de usuario y contraseña.";
                }
            } else {
                // Usuario no encontrado en el directorio LDAP
                echo "Usuario no encontrado.";
            }
        } else {
            // No se pudo autenticar con el usuario de búsqueda de LDAP
            echo "Error de autenticación con el usuario de búsqueda de LDAP.";
        }

        ldap_close($ldap_conn);
    } else {
        // No se pudo conectar a OpenLDAP
        echo "No se pudo conectar a LDAP. Verifica la configuración del servidor.";
    }
} else {
    // Acceso directo a este script sin enviar datos del formulario
    header("Location: index.html");
}
?>
