/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.models.entities;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Inheritance;
import javax.persistence.InheritanceType;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;
import static javax.persistence.TemporalType.DATE;
import javax.xml.bind.annotation.XmlRootElement;

/*
* Classe Loan (Entity)
*/

@Entity
@Table(name="LOAN")
@Inheritance(strategy=InheritanceType.SINGLE_TABLE)
public class Loan implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    @Temporal(DATE)
    private Date startDate;
    private int duration;
    private Boolean isReturned;
    @ManyToOne
    @JoinColumn(name="LIBRARYUSER") // il faut specifier la clé etrangere
    private LibraryUser user;
    @ManyToOne
    @JoinColumn(name="BOOK") // il faut specifier la clé etrangere
    private Book borrowedBook;

    public Loan() {
        super();
    }

    public Loan(Long id, Date startDate, int duration, Boolean isReturned, LibraryUser user) {
        this.id = id;
        this.startDate = startDate;
        this.duration = duration;
        this.isReturned = isReturned;
        this.user = user;
    }

    public Loan(Long id, Date startDate, int duration, Boolean isReturned, LibraryUser user, Book borrowedBook) {
        this.id = id;
        this.startDate = startDate;
        this.duration = duration;
        this.isReturned = isReturned;
        this.user = user;
        this.borrowedBook = borrowedBook;
    }    

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Date getStartDate() {
        return startDate;
    }

    public void setStartDate(Date startDate) {
        this.startDate = startDate;
    }

    public int getDuration() {
        return duration;
    }

    public void setDuration(int duration) {
        this.duration = duration;
    }

    public Boolean getIsReturned() {
        return isReturned;
    }

    public void setIsReturned(Boolean isReturned) {
        this.isReturned = isReturned;
    }

    public LibraryUser getUser() {
        return user;
    }

    public void setUser(LibraryUser user) {
        this.user = user;
    }

    public Book getBorrowedBook() {
        return borrowedBook;
    }

    public void setBorrowedBook(Book borrowedBook) {
        this.borrowedBook = borrowedBook;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (id != null ? id.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        
        if (!(object instanceof Loan)) {
            return false;
        }
        Loan other = (Loan) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "library.entities.Loan[ id=" + id + " ]";
    }
    
}
