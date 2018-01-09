/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package library.tools;

import com.sun.jersey.spi.container.ContainerRequest;
import com.sun.jersey.spi.container.ContainerResponse;
import com.sun.jersey.spi.container.ContainerResponseFilter;
import javax.ws.rs.core.MultivaluedMap;
import javax.ws.rs.ext.Provider;

/*
* Classe CrossOriginResourceSharingFilter (Provider)
*/

@Provider
public class CrossOriginResourceSharingFilter implements ContainerResponseFilter {

    public CrossOriginResourceSharingFilter() {
    }
    

    @Override
    public ContainerResponse filter(ContainerRequest creq, ContainerResponse cresp) {
        MultivaluedMap<String, Object> headers = cresp.getHttpHeaders();
        headers.add("Access-Control-Allow-Origin", "*");
        headers.add("Access-Control-Allow-Methods", "GET, POST, DELETE, PUT");
        
        return cresp;
    }
}