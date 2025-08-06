/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ConexionSQLDeveloper;

import com.sun.istack.internal.logging.Logger;
import java.sql.*;
import java.util.logging.Level;


/**
 *
 * @author Scrappy Doo Coco
 */
public class Ejemplo {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        try {
            // TODO code application logic here
            Connection con;
            Statement stmt;
            ResultSet result;
            String cadena = "insert into prueba values ('a','carlos')";
            DriverManager.registerDriver(new org.apache.derby.jdbc.ClientDriver());
            con= DriverManager.getConnection("jdbc:derby://localhost:1527/testdb","app","app");
            stmt=con.createStatement();
            stmt.executeUpdate(cadena);
        } catch (SQLException ex) {
            java.util.logging.Logger.getLogger(Ejemplo.class.getName()).log(Level.SEVERE, null, ex);
        }
        
     
    }
    
}
