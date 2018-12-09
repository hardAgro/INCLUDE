package include.trap.api.rainfall;

import org.springframework.data.elasticsearch.repository.ElasticsearchRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface RainfallRepository extends ElasticsearchRepository<Rainfall, Long> {

}
