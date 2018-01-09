/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.controllers;

import javax.ejb.Stateless;
import javax.persistence.EntityManager;
import javax.persistence.PersistenceContext;
import library.models.entities.Book;

/*
* Classe BookFacade (Stateless)
*/


@Stateless
public class BookFacade extends AbstractFacade<Book> {

    @PersistenceContext(unitName = "_Projet_CHEINISSE_ROMANIN_FOURNIER_FOURQUIN_TARAI")
    private EntityManager em;

    @Override
    protected EntityManager getEntityManager() {
        return em;
    }

    public BookFacade() {
        super(Book.class);
    }
    
}
