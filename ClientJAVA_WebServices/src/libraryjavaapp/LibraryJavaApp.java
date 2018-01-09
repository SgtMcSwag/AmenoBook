/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package libraryjavaapp;

import javax.swing.JFrame;

public class LibraryJavaApp {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        ConnectionFrame library = new ConnectionFrame();
        library.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        library.setVisible(true);
    }
    
}
